<?php

namespace App\Services;

use App\Http\Helper;
use App\Models\Lecon;
use App\Models\Candidat;
use App\Models\Vehicule;
use App\Enums\StatutEnum;
use App\Models\LeconConduite;
use App\Models\LeconAccompagnement;
use Illuminate\Support\Facades\Log;
use App\Repositories\LeconRepository;

class EventService
{
    public function getAllEvents($conditions = '')
    {
        return Lecon::with(['leconConduite', 'leconAccompagnement'])->where($conditions)->get();
    }

    public function createLecon($formateurId, $candidatId, $date, $heureDebut, $heureFin)
    {
        return Lecon::create([
            'user_id' => $formateurId,
            'candidat_id' => $candidatId,
            'date_reservation' => $date,
            'heure_debut' => $heureDebut,
            'heure_fin' => $heureFin,
            'statut_id' => StatutEnum::ATTENTE->value
        ]);
    }

    public function getCandidatFormuleRemainingHours($candidatId, $formuleId, $isConduite = true)
    {
        if($isConduite)
            return $this->getCandidatConduiteRemainingHours($candidatId, $formuleId);
        else
            return $this->getCandidatAccompagnementRemainingHours($candidatId, $formuleId);
    }

    public function getCandidatAccompagnementRemainingHours($candidatId, $formuleId)
    {
        return Candidat::where('id', $candidatId)->with('stockHeuresFormule', function($query) use($formuleId){
            $query->where('formule_conduite_id', $formuleId);
        })->first()->stockHeuresFormule[0]->quantite_accompagnement_restante;
    }

    public function getCandidatConduiteRemainingHours($candidatId, $formuleId)
    {
        return Candidat::where('id', $candidatId)->with('stockHeuresFormule', function($query) use($formuleId){
            $query->where('formule_conduite_id', $formuleId);
        })->first()->stockHeuresFormule[0]->quantite_conduite_restante;
    }

    public function hasFormule($candidatId, $formuleId)
    {
        return Candidat::where('id', $candidatId)
        ->whereHas('achatFormuleConduite', function ($query) use ($formuleId) {
            $query->where('formule_conduite_id', $formuleId);
        })
        ->exists();
    }

    public function hasCandidatHeureSupp($candidatId, $typePermisId)
    {
        return Candidat::where('id', $candidatId)
        ->whereHas('stockHeuresSupplementaires', function ($query) use ($typePermisId) {
            $query->where('type_permis_id', $typePermisId);
        })
        ->exists();
    }

    public function getCandidatSuppRemainingHours($candidatId, $typePermisId)
    {   
        return Candidat::where('id', $candidatId)->with(['stockHeuresSupplementaires' => function($query) use($typePermisId){
            $query->where('type_permis_id', $typePermisId);
        }])->first()->stockHeuresSupplementaires[0]->quantite_restante;
    }

    public function hasIntersectHoursCandidat($candidatId, $date, $heureDebut, $heureFin)
    {
        $lecons = Lecon::where('candidat_id', $candidatId)->where('date_reservation', $date)->where('statut_id', StatutEnum::PLANIFIE->value)->get();
        foreach ($lecons as $lecon) {
            if(Helper::intervalIntersect($lecon->heure_debut, $lecon->heure_fin, $heureDebut, $heureFin))
                return true;
        }
        return false;
    }

    public function error(int $code, array $errors)
    {
        return response()->json([
            'errors' => [...$errors],
        ], $code);
    }

    public function createLeconConduite($formateurId, $candidatId, $formuleId, $date, $heureDebut, $heureFin, $plaqueImm)
    {
        $lecon = $this->createLecon($formateurId, $candidatId , $date, $heureDebut, $heureFin);
        LeconConduite::create([
            'lecon_id' => $lecon->id,
            'plaque_imm' => $plaqueImm,
            'formule_conduite_id' => $formuleId
        ]);

        return $lecon;
    }

    public function createLeconAccompagnement($formateurId, $candidatId, $formuleId, $date, $heureDebut, $heureFin)
    {
        $lecon = $this->createLecon($formateurId, $candidatId , $date, $heureDebut, $heureFin);
        LeconAccompagnement::create([
            'lecon_id' => $lecon->id,
            'formule_conduite_id' => $formuleId
        ]);

        return $lecon;
    }

    public function getAvailableVehicules($date, $heureDebut, $heureFin, $typePermisId)
    {
        $vehicules = Vehicule::where('type_permis_id', $typePermisId)->get();
        $lecons = LeconConduite::with('lecon')->whereHas("lecon", function ($query) use ($date) {
            return $query->where([
                ['date_reservation', $date],
                ['statut_id', StatutEnum::PLANIFIE->value]
            ]);
        })->get();

        $intersectPlaqueVehicules = collect();

        foreach ($lecons as $leconConduite) {
            if(Helper::intervalIntersect($leconConduite->lecon->heure_debut, $leconConduite->lecon->heure_fin, $heureDebut, $heureFin))
                $intersectPlaqueVehicules->push($leconConduite->plaque_imm) ;
        }

        return $vehicules->pluck('plaque_imm')->filter(function ($plaque_imm) use($intersectPlaqueVehicules){
            return !$intersectPlaqueVehicules->contains($plaque_imm);
        });

    }
}
