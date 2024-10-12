<?php

namespace App\Http\Controllers;

use App\Http\Requests\CodeFormulaRequest;
use App\Models\Candidat;
use App\Models\FormuleCode;
use Illuminate\Support\Carbon;

class FormuleCodeController extends Controller
{

    public function store(CodeFormulaRequest $request)
    {
        $validated = $request->validated();

        // Récupération du candidat et de la formule
        $candidat = Candidat::find($validated["candidat_id"]);
        $formule_code = FormuleCode::find($validated["formule_id"]);

        // Si le candidat a déjà une formule de code illimité
        $code_candidat = $candidat->codes->pluck('duree_validite');
        
        if($code_candidat->contains(null)){
            return redirect()->route('catalogue.formules')->with('error','Le candidat a déjà une formule de code illimité');
        }

        //Ajout de l'achat de la formule au candidat
        $candidat->achatFormuleCode()->create([
            'formule_code_id' => $formule_code->formule_id,
            'date_achat' => now(),
            'date_debut' => $validated["date_debut"],
            'date_fin' => $formule_code->duree_validite ? Carbon::parse($validated["date_debut"])->addMonths($formule_code->duree_validite) : null
        ]);

        return redirect()->route('catalogue.formules')->with('success','L\'achat de la formule "'.$formule_code->formule->libelle.'" a bien été effectué');
    }

}

