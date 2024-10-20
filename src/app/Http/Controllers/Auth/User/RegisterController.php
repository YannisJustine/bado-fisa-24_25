<?php

namespace App\Http\Controllers\Auth\User;

use App\Models\TypePermis;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;

class RegisterController extends Controller
{
    public function index() 
    {
        $type_permis = TypePermis::all();
        return view('formateur.register', compact('type_permis'));
    }

    public function create(CreateUserRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            'nom' => strtolower($validated['last_name']),
            'prenom' => strtolower($validated['first_name']),
            'email' => strtolower($validated['email']),
            'password' => Hash::make($validated['password']),
        ]);

        //Crée les habilitations
        $user->typePermis()->withTimestamps()->attach($validated['habilitation']);

        return redirect()->route('home')->with('success','Le formateur a bien été enregistré');
    }
}
