<?php

namespace App\Http\Controllers;

use App\Models\Formule;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function index()
    {
        return view('catalogue');
    }

    public function show(Formule $request)
    {
        // $formules = Formule::all();
        $formules = [];
        return view("catalogue", compact('formules'));
    }
}
