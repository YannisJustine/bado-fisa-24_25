<?php

namespace App\Http\Controllers\Api;

use App\Models\Candidat;
use App\Http\Controllers\Controller;
use App\Http\Resources\CandidatCollection;

class CandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $candidats = Candidat::with(['stockHeuresSupplementaires', 'stockHeuresFormule', 'conduites', 'codes'])->get();
        return new CandidatCollection($candidats);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
