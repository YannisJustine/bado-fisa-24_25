<?php

namespace App\Services;

use App\Http\Helper;
use App\Models\User;
use App\Models\Lecon;
use App\Models\Vehicule;
use App\Enums\StatutEnum;
use App\Events\EventAsked;
use App\Enums\TypeLeconEnum;
use App\Events\EventUpdated;
use Illuminate\Support\Carbon;

class LessonService
{

    // Refuse une leçon et recherche un autre formateur la première fois
    public function deny(Lecon $lecon)
    {
        if($lecon->essais > 0)
            $this->changeStatus($lecon, StatutEnum::IMPOSSIBLE);
        else
            $this->findOtherUser($lecon);
    }

    public function findOtherUser(Lecon $lecon)
    {
        $userService = new UserService();

        $users = User::where("id", "!=", $lecon->user_id);
        
        // Vérifie les habilitations du formateur
        switch ($lecon->getType()) {
            case TypeLeconEnum::CONDUITE_FORMULE:
                $users = $users->whereHas('typePermis', function ($query) use ($lecon) {
                    $query->where('id', $lecon->leconConduite->formuleConduite->type_permis_id);
                });
                break;
            case TypeLeconEnum::ACCOMPAGNEMENT:
                $users = $users->whereHas('typePermis', function ($query) use ($lecon) {
                    $query->where('id', $lecon->leconAccompagnement->formuleConduite->type_permis_id);
                });
                break;
            case TypeLeconEnum::CONDUITE_SUPPLEMENTAIRE:
                $users = $users->whereHas('typePermis', function ($query) use ($lecon) {
                    $query->where('id', $lecon->leconConduite->vehicule->type_permis_id);
                });
                break;
            default:
                # Should not be here
                break;
        }
        
        $users = $users->inRandomOrder()->get();

        $lecon->essais++;
        
        foreach ($users as $user) {

            $lecons = $user->lecons()->where([
                ["statut_id", "=", StatutEnum::PLANIFIE->value],
                ["date_reservation", "=" ,$lecon->date_reservation]])->get();

            if ($userService->hasContinuousIntervalForHour($lecon->heure_debut, $lecon->heure_fin, $user, Carbon::parse($lecon->date_reservation)->dayOfWeek) 
                && $userService->checkFormateurLeconAvailability($lecon->heure_debut, $lecon->heure_fin, $lecons)) {
                $duplicatedLecon = $lecon->deepReplicate();
                $this->changeStatus($lecon, StatutEnum::REFUSE);
                return $this->changeUser($duplicatedLecon, $user);
            }
        }

        $this->deny($lecon);

    }

    public function findOtherVehicule(Lecon $lecon)
    {
        $event = app()->make(EventService::class);
        $vehicules = $event->getAvailableVehicules($lecon->date_reservation, $lecon->heure_debut, $lecon->heure_fin, $lecon->leconConduite->vehicule->typePermis->id);

        if(count($vehicules) < 1)
            return false;
        
        $lecon->vehicule = Vehicule::find($vehicules->random());
        return true;
    }

    public function changeUser(Lecon $lecon, User $user)
    {
        $lecon->user_id = $user->id;
        $lecon->save();
        EventAsked::dispatch($lecon);
    }

    public function changeStatus(Lecon $lecon, StatutEnum $statut)
    {
        $lecon->statut_id = $statut;
        $lecon->save();
        EventUpdated::dispatch($lecon);
    }

    public function checkHourOtherLessons(Lecon $confirmedLecon)
    {
        $candidat = $confirmedLecon->candidat;
        $lecons = $candidat->lecons->where("statut_id", StatutEnum::ATTENTE->value)->filter(
            function ($lecon) use ($confirmedLecon) {
                return $confirmedLecon->getType() == $lecon->getType();
            }
        );


        switch ($confirmedLecon->getType()) {
            case TypeLeconEnum::CONDUITE_FORMULE:
                $heuresRestantes = $candidat->stockHeuresFormule->where('formule_conduite_id', $confirmedLecon->leconConduite->formule_conduite_id)->first()->quantite_conduite_restante;
                break;
            case TypeLeconEnum::ACCOMPAGNEMENT:
                $heuresRestantes = $candidat->stockHeuresFormule->where('formule_conduite_id', $confirmedLecon->leconAccompagnement->formule_conduite_id)->first()->quantite_pedagogique_restante;
                break;
            case TypeLeconEnum::CONDUITE_SUPPLEMENTAIRE:
                $heuresRestantes = $candidat->stockHeuresSupplementaires->where('type_permis_id', $confirmedLecon->leconConduite->vehicule->type_permis_id)->first()->quantite_restante;
                break;
            default:
                $heuresRestantes = 0;
                break;
        }

        foreach ($lecons as $lecon) {

            $heureDebut = Carbon::parse($lecon->heure_debut);
            $heureFin = Carbon::parse($lecon->heure_fin);
            $heures = $heureFin->diffInHours($heureDebut);

            if ($heuresRestantes < $heures) {
                $this->changeStatus($lecon, StatutEnum::IMPOSSIBLE);
            }
        }
    }

    /**
     * Diminue le nombre d'heures du client
     * 
     * Suppose que le client a assez d'heures
     */
    public function reduceHour(Lecon $lecon)
    {
        $candidat = $lecon->candidat;
        $heureDebut = Carbon::parse($lecon->heure_debut);
        $heureFin = Carbon::parse($lecon->heure_fin);
        $heures = $heureFin->diffInHours($heureDebut);
        switch ($lecon->getType()) {
            case TypeLeconEnum::CONDUITE_FORMULE:
                $stock = $candidat->stockHeuresFormule->where('formule_conduite_id', $lecon->leconConduite->formule_conduite_id)->first();
                $stock->quantite_conduite_restante -= $heures;
                $stock->save();
                break;
            case TypeLeconEnum::ACCOMPAGNEMENT:
                $stock = $candidat->stockHeuresFormule->where('formule_conduite_id', $lecon->leconAccompagnement->formule_conduite_id)->first();
                $stock->quantite_pedagogique_restante -= $heures;
                $stock->save();
                break;
            case TypeLeconEnum::CONDUITE_SUPPLEMENTAIRE:
                $stock = $candidat->stockHeuresSupplementaires->where('type_permis_id', $lecon->leconConduite->vehicule->type_permis_id)->first();
                $stock->quantite_restante -= $heures;
                $stock->save();
                break;
            default:
                # Should not be here
                break;
        }
    }

    public function getLessonsIntersection($lecon, $searchCondition = [[]])
    {
        $leconsIntersect = [];
        $others = Lecon::where([
            ["date_reservation", "=", $lecon->date_reservation],
            ["id", "!=", $lecon->id]
        ])->when(!empty($searchCondition), function ($query) use ($searchCondition) {
            return $query->where(is_array($searchCondition[0]) ? $searchCondition : [$searchCondition]);
        })->get();

        // Récupère les leçons qui se chevauchent et qui satisfont la condition de recherche
        foreach ($others as $other) {
            if (Helper::intervalIntersect($other->heure_debut, $other->heure_fin, $lecon->heure_debut, $lecon->heure_fin)) {
                array_push($leconsIntersect, $other);
            }
        }
        return $leconsIntersect;
    }

    // Vérifie la disponibilité du formateur pour le créneau de la leçon
    public function checkUserAvailability(Lecon $lecon)
    {
        $lecons = $this->getLessonsIntersection($lecon, [["statut_id", "=", StatutEnum::PLANIFIE], ["user_id", "=", $lecon->user_id]]);

        if (count($lecons) > 0) {
            return false;
        }

        return true;
    }

    // Vérifie la disponibilité du véhicule et en change si nécessaire sans sauvegarder la modification dans la base de données
    public function checkVehiculeAvailability(Lecon $lecon)
    {
        if(!$lecon->leconConduite) {
            return true;
        }

        if($lecon->leconConduite->vehicule->intersect($lecon->date_reservation, $lecon->heure_debut, $lecon->heure_fin)) {
            // Essaie de trouver un autre véhicule
            if(!$this->findOtherVehicule($lecon))
                return false;
        }

        return true;
    }


    // Valide une leçon en refusant les autres leçons qui se chevauchent
    public function accept(Lecon $lecon)
    {
        // On ne vérifie pas le nombre d'heures restantes car la base de données ne devrait pas permettre de créer une leçon si le client n'a pas assez d'heures
        $this->denyOtherLecons($lecon);
        $this->changeStatus($lecon, StatutEnum::PLANIFIE);
        $this->reduceHour($lecon);
        $this->checkHourOtherLessons($lecon);
    }

    /**
     * Refuse les leçons qui se chevauchent avec la leçon passée en paramètre
     * 
     * Les leçons du formateur sont refusées et les leçons du client sont passées en impossible
     */
    public function denyOtherLecons(Lecon $lecon)
    {
        $lecons_formateur = $this->getLessonsIntersection($lecon, [["statut_id", "=", StatutEnum::ATTENTE], ["user_id", "=", $lecon->user_id]]);
        $lecons_candidat = $this->getLessonsIntersection($lecon, [["statut_id", "=", StatutEnum::ATTENTE], ["candidat_id", "=", $lecon->candidat_id]]);
        foreach ($lecons_formateur as $lecon) {
            $this->deny($lecon);
        }
        foreach ($lecons_candidat as $lecon) {
            $this->changeStatus($lecon, StatutEnum::IMPOSSIBLE);
        }
    }

    public function verifyLessonDate(Lecon $lecon)
    {
        $date = Carbon::parse($lecon->date_reservation);
        $now = Carbon::now();
        $diff = $date->diffInDays($now);

        if ($diff < 0) {
            $this->changeStatus($lecon, StatutEnum::IMPOSSIBLE);
        }
    }
}