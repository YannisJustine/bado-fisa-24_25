@extends('layouts.main')

@section('title')
    Login
@endsection



@section('content')
    <div class="py-20 flex flex-col px-6  lg:px-8 bg-center bg-no-repeat  bg-cover text-white">
        <div class=" mx-auto w-full bg-gray-700 bg-opacity-20 max-w-lg p-5 rounded-t-2xl">
            <h2 class="mt-5 text-center text-2xl font-bold leading-9 tracking-tight text-shadow-sm shadow-black mb-10">
                Inscription d'un formateur
            </h2>
            <form class="space-y-6" action="{{ route('register.user.post') }}" method="POST">
                <x-input type="text" name="last_name" label="Nom" />
                <x-input type="text" name="first_name" label="Prénom" />
                <x-input type="text" name="email" label="Adresse mail" />
                <x-input name="password" label="Mot de passe" type="password" />
                <x-input name="password_confirmation" label="Confirmation du mot de passe" type="password" />
                <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Habilitations</h3>
                @foreach ($type_permis as $permis)
                    <div class="flex items-center mb-4">
                        <input id="permis-{{ $permis->id }}" type="checkbox" value="{{ $permis->id }}" name="habilitation[]" class="w-4 h-4 text-logo-orange-600 bg-gray-100 border-gray-300 rounded focus:ring-logo-orange-500 dark:focus:ring-logo-orange-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="permis-{{ $permis->id }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $permis->libelle }}</label>
                    </div>
                @endforeach
                @csrf
                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-ensiie-main-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-logo-orange-500 bg-logo-orange-600">Valider</button>
                </div>
            </form>
        </div>
        
    </div>
@endsection