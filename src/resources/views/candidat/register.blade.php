@extends('layouts.main')

@section('title')
    Login
@endsection



@section('content')
    <div class="py-20 flex flex-col px-6  lg:px-8 bg-center bg-no-repeat  bg-cover text-white">
        <div class=" mx-auto w-full bg-gray-700 bg-opacity-20 max-w-lg p-5 rounded-t-2xl">
            <h2 class="mt-5 text-center text-2xl font-bold leading-9 tracking-tight text-shadow-sm shadow-black mb-10">
                Inscription d'un candidat
            </h2>
            <form class="space-y-6" action="{{ route('register.candidat.post') }}" method="POST">
                <x-input type="text" name="last_name" label="Nom" />
                <x-input type="text" name="first_name" label="Prénom" />
                <x-input type="text" name="address" label="Adresse" />
                <x-input type="email" name="email" label="Adresse mail" />
                <x-input type="text" name="phone" label="Téléphone" />
                <div class="relative">
                    <label for="birthday" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-logo-orange-600 peer-focus:dark:text-logo-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Date de naissance</label>
                    <input type="date" name="birthday" id="birthday" max="{{ date('Y-m-d') }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-logo-orange-500 focus:outline-none focus:ring-0 focus:border-logo-orange-600 peer" >
                    @error('birthday')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                @csrf

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-ensiie-main-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-logo-orange-500 bg-logo-orange-600">Valider</button>
                </div>
            </form>
        </div>
        
    </div>
@endsection