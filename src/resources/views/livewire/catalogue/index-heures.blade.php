<main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grow">
    <div class="border-b border-gray-200 pb-6 pt-24">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white">Heures supplémentaires</h1>
    </div>


    <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
        <!-- Filters -->
        <div class="mt-5">
            <h3 class="text-lg font-semibold tracking-tight text-gray-900 dark:text-white">Filtres</h3>
            <div class="my-5">
                <x-livewire.search-bar name="search-filter" placeholder="Nom formule"/>
            </div>
        </div>

        <!-- Product grid -->
        <div class="lg:col-span-3 ">
            <div class="container mx-auto flex flex-row flex-wrap  flex-1 ">

                @forelse ($permis as $permis_unitaire)
                    <div
                        class="m-8 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a
                            href="{{ route('catalogue.heures_supp.type_permis', ['type_permis' => $permis_unitaire->id]) }}">
                            <img class="rounded-t-lg" src="https://placehold.co/600x400" alt="image" />
                        </a>
                        <div class="p-5">
                            <a
                                href="{{ route('catalogue.heures_supp.type_permis', ['type_permis' => $permis_unitaire->id]) }}">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $permis_unitaire->libelle }}</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Prix:
                                {{ $permis_unitaire->prix_unitaire }}€</p>
                            <a href="{{ route('catalogue.heures_supp.type_permis', ['type_permis' => $permis_unitaire->id]) }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-logo-orange-700 rounded-lg hover:bg-logo-orange-800 focus:ring-4 focus:outline-none focus:ring-logo-orange-300 dark:bg-logo-orange-600 dark:hover:bg-logo-orange-700 dark:focus:ring-logo-orange-800">
                                Détails heures supplémentaires
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-red-500">Aucun permis n'est disponible</div>
                @endforelse

            </div>
        </div>
    </div>
</main>