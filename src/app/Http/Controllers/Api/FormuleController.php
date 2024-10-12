<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\FormuleCollection;
use App\Http\Controllers\Controller;
use App\Models\Formule;

class FormuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {;
        return new FormuleCollection(Formule::with('formuleConduite')->get());
    }
}
