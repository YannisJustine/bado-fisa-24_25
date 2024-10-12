@extends('layouts.app')

@section('title')
    Connexion
@endsection

@section('body')
    <div class="flex h-screen flex-col justify-center px-6 py-12 lg:px-8 bg-center bg-no-repeat bg-gray-200 bg-blend-multiply bg-cover text-white" style="background-image: url('{{ Vite::asset('resources/images/background_login.jpg') }}')">
        <div class="mt-10 sm:mx-auto sm:w-full bg-gray-800  sm:max-w-lg sm:p-5 bg-opacity-90">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <img class="mx-auto max-h-24 w-auto" src="{{ Vite::asset('resources/images/logo/RoulerMalin.svg') }}" alt="Logo auto-école">
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-shadow-sm shadow-black">Se connecter à son compte
                </h2>
            </div>
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <ul class="list-disc">
                            @foreach($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="num_secu" id="num_secu" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-logo-orange-500 focus:outline-none focus:ring-0 focus:border-logo-orange-600 peer" placeholder=" " required />
                        <label for="num_secu" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-logo-orange-600 peer-focus:dark:text-logo-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Numéro de sécurité sociale</label>
                    </div>
                </div>
                <div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="password" name="password" id="password" autocomplete="on" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-logo-orange-500 focus:outline-none focus:ring-0 focus:border-logo-orange-600 peer" placeholder=" " required />
                        <label for="password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-logo-orange-600 peer-focus:dark:text-logo-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6" >Mot de passe</label>
                    </div>
                <div>
                <div class="flex items-center justify-between">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="remember" name="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 text-logo-orange-500 focus:ring-logo-orange-500 dark:focus:ring-logo-orange-600 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="remember" class="text-gray-500 dark:text-gray-300">Se souvenir de moi</label>
                        </div>
                    </div>
                
                </div>
                <div class="mt-5">
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-logo-orange-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm ">Se connecter</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-white">
                Pas encore membre ?
                <a href="{{ route('register.candidat') }}" class="font-semibold leading-6 text-logo-orange-400 hover:text-logo-orange-600">
                    S'inscrire
                </a>
            </p>
        </div>
    </div>
@endsection
