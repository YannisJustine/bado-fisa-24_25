<div class="max-w-7xl mx-auto" wire:ignore.self>
    <div class="my-16">
            <h1 class="dark:text-gray-200 text-center size text-5xl" >
                Chercher un Candidat
            </h1>
        <div class="py-8">
            <div class="flex flex-row justify-end">
                <x-livewire.search-bar />
            </div>
            <x-list wire:loading.remove>
                @forelse ($candidats as $candidat)
                    <x-list.cell class="bg-slate-600">
                        <div class="flex justify-between items-center">
                            <div class="flex flex-col text-lg">
                                <span>
                                    {{ $candidat->nom }}
                                </span>
                                <span>
                                    {{ $candidat->prenom }}
                                </span>
                                <span class="inline-flex">
                                    <svg class="w-6 h-6 me-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                        <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                                        <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                                    </svg>
                                    {{ $candidat->email }}
                                </span>
                            </div>
                            <div class="">
                                <x-button class="text-center inline-flex items-center ">
                                    Détails
                                    <svg class="w-3 h-3 text-white ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                        <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                                    </svg>
                                </x-button>
                            </div>
                        </div>
                    </x-list.cell>
                @empty
                    <x-list.cell class="bg-slate-600">
                        <div class="flex justify-center items-center">
                            <div>
                                Aucun utilisateurs
                            </div>
                        </div>
                    </x-list.cell>
                @endforelse
            </x-list>
        </div>

        {{-- Loading --}}
        <x-loading.list wire:loading.delay />

        <div class="flex justify-center" wire:loading.remove>
            {{ $candidats->links('pagination.custom-livewire') }}
        </div>
    </div>
</div>

