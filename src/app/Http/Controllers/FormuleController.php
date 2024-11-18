<?php

namespace App\Http\Controllers;

use App\Models\Formule;

class FormuleController extends Controller
{

    public function index()
    {
        return view("catalogue.formules.index");
    }

    public function show(Formule $formule)
    {
        return view("catalogue.formules.formule", compact('formule'));
    }
}
