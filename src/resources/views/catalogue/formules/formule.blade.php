@extends('layouts.main')

@section('content')
    @if($errors->any())
        <div class="bg-red-200 text-red-600">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        
    <div class="container mx-auto flex flex-row flex-wrap justify-evenly flex-1 items-center text-white">
        <div class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-xl font-medium text-gray-900 dark:text-white mb-5">Formule {{ $formule->libelle }}</h5>

            <div class="border-gray-300 rounded-md border-2 my-5 p-2">
                <h6 class="mb-3 text-l text-center italic font-semibold text-gray-900 dark:text-white">Informations</h6>

            @if($formule->isFormuleConduite())
                <p class="text-sm font-normal text-gray-900 dark:text-white">Age minimum: {{ $formule->formuleConduite->age_minimum ?? $formule->formuleConduite->typePermis->age_minimum_requis }}</p>
                @if($formule->formuleConduite->age_maximum)
                    <p class="text-sm font-normal text-gray-900 dark:text-white">Age maximum: {{ $formule->formuleConduite->age_maximum }}</p>
                @endif
                <p class="text-sm font-normal text-gray-900 dark:text-white">Nombre d'heures de conduite: {{ $formule->formuleConduite->nb_heures_conduite }}</p>
                @if($formule->formuleConduite->nb_heures_pedagogique)
                    <p class="text-sm font-normal text-gray-900 dark:text-white">Nombre d'heures de conduite supplémentaire(s)  : {{ $formule->formuleConduite->nb_heures_pedagogique }}</p>
                @endif
            @elseif($formule->isFormuleCode())
                @if($formule->formuleCode->duree_validite)
                    <p class="text-sm font-normal text-gray-900 dark:text-white"> Durée du forfait code: {{ $formule->formuleCode->duree_validite }} mois</p>
                @else
                    <p class="text-sm font-normal text-gray-900 dark:text-white"> Durée du forfait code: illimité</p>
                @endif
            @endif

            </div>

        @if($formule->isFormuleCode())
            <form class="space-y-6" action="{{ route('achat.formules.code') }}" method="POST">
        @else
            <form class="space-y-6" action="{{ route('achat.formules.conduite') }}" method="POST">
        @endif
            <div>
            @if($formule->isFormuleCode())
                @if($formule->formuleCode->duree_validite != null)
                    <label for="datepickerId" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de début</label>
                    <div class="relative max-w-sm">
                        <label for="date_debut" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-logo-orange-600 peer-focus:dark:text-logo-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Date de naissance</label>

                        <input type="date" name="date_debut" id="date_debut" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-logo-orange-500 focus:outline-none focus:ring-0 focus:border-logo-orange-600 peer" required>
                    </div>
                @else
                    <input hidden name="date_debut" value="{{ date('Y-m-d') }}" >
                @endif
            @endif
            </div>
            <input type="hidden" name="formule_id" value="{{ $formule->id }}">
            @csrf
            <div class="flex items-center">
                <p class="text-xl ms-auto font-medium text-gray-900 dark:text-white start">{{ $formule->prix }}€</p>
            </div>
            <button type="submit" class="w-full text-white bg-logo-orange-700 hover:bg-logo-orange-800 focus:ring-4 focus:outline-none focus:ring-logo-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-logo-orange-600 dark:hover:bg-logo-orange-700 dark:focus:ring-logo-orange-800">Confirmer l'achat</button>
            </form>
        </div>
    </div>
        
@endsection