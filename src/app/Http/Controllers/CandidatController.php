<?php

namespace App\Http\Controllers;

use App\Models\Candidat;

class CandidatController extends Controller
{
    public function show(Candidat $candidat) 
    {
        $candidat->load([
            'codes' => function ($query) { 
                $query->with('formule');
                $query->withPivot(['date_achat', 'date_debut', 'date_fin']);
            },
            'stockHeuresFormule' => function ($query) { 
                $query->with('formule');
            },
            'lecons' => function ($query) { 
                $query->with(['leconConduite', 'leconAccompagnement']);
            },
            'stockHeuresSupplementaires' => function ($query) { 
                $query->with('typePermis');
            },
            
        ]);

        return view("candidat.profil.index", [ "candidat" => $candidat ] );
    }
}

