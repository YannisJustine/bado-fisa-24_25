<?php

namespace App\Http\Controllers\Api;

use App\Models\TypePermis;
use App\Http\Controllers\Controller;
use App\Http\Resources\TypePermisCollection;

class PermisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new TypePermisCollection(TypePermis::all());
    }
}
