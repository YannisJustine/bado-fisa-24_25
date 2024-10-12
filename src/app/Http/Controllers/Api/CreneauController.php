<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Creneau;
use App\Models\HoraireFormateur;
use App\Http\Controllers\Controller;
use App\Http\Resources\CreneauCollection;

class CreneauController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $horaires = HoraireFormateur::all()->pluck('creneau_id');
        return (new CreneauCollection(Creneau::whereIn('id', $horaires)->get()));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        
    }
}
