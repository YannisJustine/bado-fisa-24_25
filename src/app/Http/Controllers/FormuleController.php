<?php

namespace App\Http\Controllers;

use App\Models\Formule;
use App\Models\Candidat;

class FormuleController extends Controller
{

    public function index()
    {
        return view("catalogue.formules.index");
    }

    public function show(Formule $formule)
    {
        // Si la formule a une formuleConduite, on ne peut pas s'inscrire si l'on a pas l'âge requis
        if($formule->isFormuleConduite())
        {
            
            $age_minmimum_requis = $formule->formuleConduite->age_minimum ?? $formule->formuleConduite->typePermis->age_minimum_requis;
            $age_maximum_requis = $formule->formuleConduite->age_maximum ?? 150; // 150 ans, devrait être suffisant pour tout le monde

            $date_naissance_minimum = now()->subYears($age_minmimum_requis);
            $date_naissance_maximum= now()->subYears($age_maximum_requis);

            $candidats = Candidat::where('date_naissance', '<=', $date_naissance_minimum)
                                        ->where('date_naissance', '>=', $date_naissance_maximum)
                                        ->get();
        }
        else
            $candidats = Candidat::all();
        
        return view("catalogue.formules.formule", compact('formule', 'candidats'));
    }
}
