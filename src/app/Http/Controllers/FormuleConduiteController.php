<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\FormuleConduite;
use App\Http\Requests\DrivingFormulaRequest;

class FormuleConduiteController extends Controller
{

    public function store(DrivingFormulaRequest $request)
    {
        $validated = $request->validated();

        // Récupération du candidat et de la formule
        $candidat = Candidat::find($validated["candidat_id"]);
        $formule_conduite = FormuleConduite::find($validated["formule_id"]);

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

