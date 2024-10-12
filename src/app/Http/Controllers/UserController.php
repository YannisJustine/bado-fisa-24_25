<?php

namespace App\Http\Controllers;

use App\Models\Creneau;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show() 
    {
        $user = Auth::user();
        return view("formateur.index", compact('user'));
    }
}

