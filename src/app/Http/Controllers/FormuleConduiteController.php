<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\FormuleConduite;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DrivingFormulaRequest;

class FormuleConduiteController extends Controller
{

    public function store(DrivingFormulaRequest $request)
    {
        $validated = $request->validated();

        // Récupération du candidat et de la formule
        $candidat = Auth::guard('candidat')->user();
        $formule_conduite = FormuleConduite::find($validated["formule_id"]);

        $ageMin = $formule_conduite->age_minimum ?? $formule_conduite->typePermis->age_minimum_requis;
        $ageMax = $formule_conduite->age_maximum ?? $formule_conduite->typePermis->age_maximum_requis;

        // Vérification de l'âge du candidat 
        $candidat->age = now()->diffInYears($candidat->date_naissance);
        if ($ageMin && $candidat->age < $ageMin) {
            return redirect()->back()->with('error','Vous n\'avez pas l\'âge requis pour acheter cette formule');
        }
        if ($ageMax && $candidat->age > $ageMax) {
            return redirect()->back()->with('error','Vous avez dépassé l\'âge maximum pour acheter cette formule');
        }

        // Ajout de l'achat de la formule au candidat
        $candidat->achatFormuleConduite()->create([
            'formule_conduite_id' => $formule_conduite->formule_id,
            'date_achat' => now(),
        ]);


        // Si le candidat n'a pas de stock d'heures pour cette formule, on en crée un sinon on met à jour le stock
        if ($candidat->stockHeuresFormule()->where('formule_conduite_id', $formule_conduite->formule_id)->doesntExist()) {
            $candidat->stockHeuresFormule()->create([
                'formule_conduite_id' => $formule_conduite->formule_id,
                'quantite_conduite_restante' => $formule_conduite->nb_heures_conduite,
                'quantite_pedagogique_restante' => $formule_conduite->nb_heures_pedagogique ?? 0,
            ]);
        } else {
            $stock = $candidat->stockHeuresFormule()->where('formule_conduite_id', $formule_conduite->formule_id)->first();
            $stock->update([
                'quantite_conduite_restante' => $stock->quantite_conduite_restante + $formule_conduite->nb_heures_conduite,
                'quantite_pedagogique_restante' => $stock->quantite_pedagogique_restante + $formule_conduite->nb_heures_pedagogique,
            ]);
        }

        return redirect()->route('catalogue.formules')->with('success','L\'achat de la formule "'.$formule_conduite->formule->libelle.'" a bien été effectué');
    }

}

