<?php

namespace App\Http\Controllers\Auth\Candidat;

use App\Models\Candidat;
use Illuminate\Routing\Controller;
use App\Http\Requests\CreateApplicantRequest;

class RegisterController extends Controller
{
    public function index() 
    {
        return view('candidat.register');
    }

    public function create(CreateApplicantRequest $request)
    {
        $validated = $request->validated();
        $candidate = Candidat::create([
            'nom' => strtolower($validated['last_name']),
            'prenom' => strtolower($validated['first_name']),
            'email' => strtolower($validated['email']),
            'adresse' => $validated['address'],
            'telephone' => $validated['phone'],
            'date_naissance' => $validated['birthday']
        ]);


        return redirect()->route('home')->with('success','Le candidat a bien été enregistré');
    }
}
