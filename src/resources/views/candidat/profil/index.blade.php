@extends('layouts.livewire')

@section('title')
    Profil du Candidat
@endsection

@section('content')
    <div class="flex flex-1 my-10">
        <ul class="text-sm font-medium text-gray-800 dark:text-gray-400  ml-5 p-2 rounded-t-xl "
            id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist" data-active-classes="bg-logo-orange-100 dark:bg-gray-800 text-logo-orange-600 dark:text-white">
            <li>
                <button class="inline-flex items-center px-4 py-3 rounded-lg w-full border" id="infos-tab"
                    data-tabs-target="#infos" type="button" role="tab" aria-controls="infos" aria-selected="false">
                    <svg class="w-4 h-4 me-2 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                    </svg>
                    Informations
                </button>
            </li>
            <li class="my-2">
                <button class="inline-flex items-center px-4 py-3 rounded-lg w-full border" id="formules-tab"
                    data-tabs-target="#formules" type="button" role="tab" aria-controls="formules"
                    aria-selected="false">
                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path d="M9 1.334C7.06.594 1.646-.84.293.653a1.158 1.158 0 0 0-.293.77v13.973c0 .193.046.383.134.55.088.167.214.306.366.403a.932.932 0 0 0 .5.147c.176 0 .348-.05.5-.147 1.059-.32 6.265.851 7.5 1.65V1.334ZM19.707.653C18.353-.84 12.94.593 11 1.333V18c1.234-.799 6.436-1.968 7.5-1.65a.931.931 0 0 0 .5.147.931.931 0 0 0 .5-.148c.152-.096.279-.235.366-.403.088-.167.134-.357.134-.55V1.423a1.158 1.158 0 0 0-.293-.77Z"/>
                      </svg>
                    Formules
                </button>
            </li>
            <li class="my-2">
                <button class="inline-flex items-center px-4 py-3 rounded-lg w-full border" id="heures-supp-tab"
                    data-tabs-target="#heures-supp" type="button" role="tab" aria-controls="heures" aria-selected="false">
                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 21">
                        <path d="M15 14H7.78l-.5-2H16a1 1 0 0 0 .962-.726l.473-1.655A2.968 2.968 0 0 1 16 10a3 3 0 0 1-3-3 3 3 0 0 1-3-3 2.97 2.97 0 0 1 .184-1H4.77L4.175.745A1 1 0 0 0 3.208 0H1a1 1 0 0 0 0 2h1.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 10 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3Zm-8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm8 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                        <path d="M19 3h-2V1a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V5h2a1 1 0 1 0 0-2Z"/>
                      </svg>
                    Heures Supp
                </button>
            </li>
             <li class="my-2">
                <button class="inline-flex items-center px-4 py-3 rounded-lg w-full border" id="heures-planifie-tab"
                    data-tabs-target="#heures-planifie" type="button" role="tab" aria-controls="planifie" aria-selected="false">
                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20">
                        <path d="M13 20a1 1 0 0 1-.64-.231L7 15.3l-5.36 4.469A1 1 0 0 1 0 19V2a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v17a1 1 0 0 1-1 1Z"/>
                      </svg>
                    Planifiées
                </button>
            </li>
        </ul>
        <div id="default-tab-content" class="w-full ml-5 mr-10">
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="infos" role="tabpanel"
                aria-labelledby="infos-tab">
                <div>
                    <h3>
                        <span
                            class="text-2xl font-medium text-gray-800 dark:text-gray-100 hover:underline">
                            Informations
                        </span>
                    </h3>
                    <div class="mt-5 mx-auto max-w-lg">
                        <div class="mb-6">
                            <label for="firstname"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                            <input type="text" id="firstname"
                                class="rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-logo-orange-500 focus:border-logo-orange-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-logo-orange-500 dark:focus:border-logo-orange-500"
                                readonly value="{{ $candidat->prenom }}">
                        </div>
                        <div class="mb-6">
                            <label for="lastname"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                            <input type="text" id="lastname"
                                class="rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-logo-orange-500 focus:border-logo-orange-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-logo-orange-500 dark:focus:border-logo-orange-500"
                                readonly value="{{ $candidat->nom }}">
                        </div>
                        <div class="mb-6">
                            <label for="lastname"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="text" id="lastname"
                                class="rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-logo-orange-500 focus:border-logo-orange-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-logo-orange-500 dark:focus:border-logo-orange-500"
                                readonly value="{{ $candidat->email }}">
                        </div>
                        <div class="mb-6">
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date
                                de naissance</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="date" type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-logo-orange-500 focus:border-logo-orange-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-logo-orange-500 dark:focus:border-logo-orange-500"
                                    readonly value="{{ $candidat->date_naissance->format('d-m-Y') }}">
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="phone"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro de
                                téléphone</label>
                            <div class="relative ">
                                <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                                        <path
                                            d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z" />
                                    </svg>
                                </div>
                                <input type="text" id="phone" aria-describedby="helper-text-explanation"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-logo-orange-500 focus:border-logo-orange-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-logo-orange-500 dark:focus:border-logo-orange-500"
                                    readonly value="{{ $candidat->telephone }}">
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="address"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse</label>
                            <div class="relative ">
                                <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                        <path
                                            d="M8 0a7.992 7.992 0 0 0-6.583 12.535 1 1 0 0 0 .12.183l.12.146c.112.145.227.285.326.4l5.245 6.374a1 1 0 0 0 1.545-.003l5.092-6.205c.206-.222.4-.455.578-.7l.127-.155a.934.934 0 0 0 .122-.192A8.001 8.001 0 0 0 8 0Zm0 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                                    </svg>
                                </div>
                                <input type="text" id="address" aria-describedby="helper-text-explanation"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-t-lg focus:ring-logo-orange-500 focus:border-logo-orange-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-logo-orange-500 dark:focus:border-logo-orange-500"
                                    readonly value="{{ preg_replace("/\n/", ' ', $candidat->adresse) }}">
                            </div>
                            <custom-map address="{{ preg_replace("/\n/", ' ', $candidat->adresse) }}"
                                class-style="rounded-b-lg" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 h-full" id="formules"
                role="tabpanel"aria-labelledby="formules-tab">
                <div class="flex flex-col h-full">
                    <div class="flex-1 flex flex-col">
                        <h3>
                            <span class="text-2xl font-medium text-gray-800 dark:text-gray-100 hover:underline">Formules de
                                code</span>
                        </h3>
                        @if ($candidat->codes->isEmpty())
                            <div class="my-5 grid grid-cols-1 h-full">
                                <div
                                    class="bg-gray-100 dark:bg-gray-700 divide-y-2 rounded-t-lg w-full flex justify-center items-center text-gray-900 dark:text-white">
                                    <span>Vous n'avez pas encore de formule de code</span>
                                </div>
                            </div>
                        @else
                            <x-table class="mt-5">
                                <x-slot name="header">
                                    <x-table.header>Libelle</x-table.header>
                                    <x-table.header>Date d'achat</x-table.header>
                                    <x-table.header>Date de début</x-table.header>
                                    <x-table.header>Date de fin</x-table.header>
                                </x-slot>
                                <x-slot name="body">
                                    @foreach ($candidat->codes as $formuleCode)
                                        <x-table.row>
                                            <x-table.cell> 
                                                <x-navigation.link class="hover:underline" href="{{ route('catalogue.formules.formule', ['formule' => $formuleCode->formule->libelle]) }}"> {{ $formuleCode->formule->libelle }} </x-navigation.link>
                                            </x-table.cell>
                                            
                                            <x-table.cell>{{ $formuleCode->pivot->date_achat->format("d/m/Y") }}</x-table.cell>
                                            <x-table.cell>{{ $formuleCode->pivot->date_debut->format("d/m/Y") }}</x-table.cell>
                                            <x-table.cell>   
                                                @if($formuleCode->pivot->date_fin)
                                                    {{ $formuleCode->pivot->date_fin->format("d-m-Y") }}
                                                @endif
                                            </x-table.cell>
                                        </x-table.row>
                                    @endforeach
                                </x-slot>
                            </x-table>
                        @endif
                    </div>
                    <div class="flex-1 flex flex-col">
                        <h3>
                            <span class="text-2xl font-medium text-gray-800 dark:text-gray-100 hover:underline">Formules de conduites</span>
                        </h3>
                        @if ($candidat->conduites->isEmpty())
                            <div class="my-5 grid grid-cols-1 h-full">
                                <div
                                    class="bg-gray-100 dark:bg-gray-700 divide-y-2 rounded-t-lg w-full flex justify-center items-center text-gray-900 dark:text-white">
                                    <span>Vous n'avez pas encore acheté de formule de conduite</span>
                                </div>
                            </div>
                        @else
                            <div class="my-5 grid grid-cols-3 gap-10 h-full">
                                @foreach ($candidat->stockHeuresFormule as $stockHeureFormule)

                                    <div class="bg-gray-100 dark:bg-gray-700 divide-y-2 rounded-t-lg">
                                        <div class="text-center py-2 ">
                                            <a href="{{ route('catalogue.formules.formule', ['formule' => $stockHeureFormule->formule->libelle]) }}"
                                                class="text-lg font-medium text-gray-900 dark:text-white hover:text-gray-600 hover:dark:text-gray-400 ">
                                                {{ $stockHeureFormule->formule->libelle }}
                                            </a>
                                        </div>
                                        <div class="py-4 px-2 text-gray-900 dark:text-white">
                                            <ul>
                                                <li class="pt-2">
                                                    <span>Nombre d'heures de conduite restantes :</span>
                                                    <span
                                                        class="float-right font-bold tracking-tight">{{ $stockHeureFormule->quantite_conduite_restante }}
                                                    </span>
                                                </li>
                                                <li class="pt-2">
                                                    <span>Nombre d'heures pédagogiques restantes :</span>
                                                    <span
                                                        class="float-right font-bold tracking-tight">{{ $stockHeureFormule->quantite_pedagogique_restante }}
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 h-full" id="heures-supp" role="tabpanel"
                aria-labelledby="heures-supp-tab">
                <div class="flex flex-col h-full">
                    <div class="flex flex-col">
                        <h3>
                            <span class="text-2xl font-medium text-gray-800 dark:text-gray-100 hover:underline">Heures supplémentaire de conduites</span>
                        </h3>
                        @if ($candidat->stockHeuresSupplementaires->isEmpty())
                            <div class="my-5 grid grid-cols-1">
                                <div
                                    class="py-12 bg-gray-100 dark:bg-gray-700 divide-y-2 rounded-t-lg w-full flex justify-center items-center text-gray-900 dark:text-white">
                                    <span>Vous n'avez pas encore acheté d'heures supplémentaire de conduites</span>
                                </div>
                            </div>
                        @else
                            <div class="my-5 grid grid-cols-3 gap-10 h-full">
                                @foreach ($candidat->stockHeuresSupplementaires as $stockHeureSupplementaire)

                                    <div class="bg-gray-100 dark:bg-gray-700 divide-y-2 rounded-t-lg">
                                        <div class="text-center py-2 ">
                                            <a href="{{ route('catalogue.heures_supp.type_permis', ['type_permis' => $stockHeureSupplementaire->typePermis->id]) }}"
                                                class="text-lg font-medium text-gray-900 dark:text-white hover:text-gray-600 hover:dark:text-gray-400 ">
                                                {{ $stockHeureSupplementaire->typePermis->libelle }}
                                            </a>
                                        </div>
                                        <div class="py-4 px-2 text-gray-900 dark:text-white">
                                            <ul>
                                                <li class="pt-2">
                                                    <span>Nombre d'heures de conduite restantes :</span>
                                                    <span class="float-right font-bold tracking-tight">
                                                        {{ $stockHeureSupplementaire->quantite_restante }}
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 h-full" id="heures-planifie" role="tabpanel"
                aria-labelledby="planifie-tab">
                <div class="flex flex-col h-full">
                    <div class="flex flex-col">
                        <h3>
                            <span class="text-2xl font-medium text-gray-800 dark:text-gray-100 hover:underline">Heures planifiées</span>
                        </h3>
                        <div class="my-5">
                            <livewire:candidat-lecons :candidatId="$candidat->id" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    @vite(['resources/js/tabs.js'])
@endpush
