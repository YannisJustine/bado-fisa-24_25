<main class="mx-auto max-w-7xl px-4 grow w-full">
    <div class="border-b border-gray-200 pb-6 pt-24">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white">Formules</h1>
    </div>


    <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
        <!-- Filters -->
        <div class="mt-5">
            <h3 class="text-lg font-semibold tracking-tight text-gray-900 dark:text-white">Filtres</h3>
            <div class="my-5">
                <x-livewire.search-bar name="search-filter" placeholder="Nom formule"/>
            </div>
            <div id="accordion-flush" data-accordion="open" data-inactive-classes="text-gray-500"
                data-active-classes="dark:text-gray-400" wire:ignore.self>
                <h2 id="accordion-flush-heading-1" wire:ignore>
                    <button type="button"
                        class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 gap-3"
                        data-accordion-target="#accordion-flush-body-1" aria-expanded="false"
                        aria-controls="accordion-flush-body-1">
                        <span>Type</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1"
                    wire:ignore.self>
                    <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center mb-4">
                            <input wire:model="formule_type" name="formule_type" id="default-type-radio" type="radio"
                                value=""
                                class="w-4 h-4 text-logo-orange-600 bg-gray-100 border-gray-300 focus:ring-logo-orange-500 dark:focus:ring-logo-orange-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="default-type-radio"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Tous
                            </label>
                        </div>
                        <div class="flex items-center mb-4">
                            <input wire:model="formule_type" name="formule_type" id="code-type-radio" type="radio"
                                value="Code"
                                class="w-4 h-4 text-logo-orange-600 bg-gray-100 border-gray-300 focus:ring-logo-orange-500 dark:focus:ring-logo-orange-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="code-type-radio"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Code
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input wire:model="formule_type" name="formule_type" id="conduite-type-radio" type="radio"
                                value="Conduite"
                                class="w-4 h-4 text-logo-orange-600 bg-gray-100 border-gray-300 focus:ring-logo-orange-500 dark:focus:ring-logo-orange-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="conduite-type-radio"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Conduite
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product grid -->
        <div class="lg:col-span-3 ">
            <div class="container mx-auto flex flex-row flex-wrap justify-evenly flex-1 items-center">
                @forelse ($formules as $formule)
                    <x-product.index :libelle="$formule->libelle" :prix="$formule->prix" button="Détails formule" :link="route('catalogue.formules.formule', ['formule' => $formule->libelle])" />
                @empty
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">Aucune formule</p>
                        <p class="text-xl font-normal text-gray-700 dark:text-gray-400">Aucune formule ne
                            correspond à votre recherche.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</main>