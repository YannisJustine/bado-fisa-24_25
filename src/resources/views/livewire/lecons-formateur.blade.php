<div class="flex flex-col grow w-full">
    @if (session()->has('error'))
        <div class="mt-10 sm:mx-auto sm:w-full bg-red-700 bg-opacity-20 sm:max-w-lg sm:p-5">
            <div class="text-center text-red-500">
                <h2 class="text-2xl font-bold leading-9 tracking-tight text-shadow-sm shadow-black">Erreur
                </h2>
                <p class="mt-2 text-sm text-red-500"> {{ session('error') }}</p>
            </div>
        </div>
    @elseif(session()->has('success'))
        <div class="mt-10 sm:mx-auto sm:w-full bg-green-700 bg-opacity-20 sm:max-w-lg sm:p-5">
            <div class="text-center text-green-500">
                <h2 class="text-2xl font-bold leading-9 tracking-tight text-shadow-sm shadow-black">Succès
                </h2>
                <p class="mt-2 text-sm text-green-500"> {{ session('success') }}</p>
            </div>
        </div>
    @endif
    <div class="grow">
        <table class="w-full overflow-hidden  text-sm text-left text-gray-500 dark:text-gray-400 rounded-t-lg">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">
                        <div class="flex items-center">
                            N°
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3">
                        <div class="flex items-center">
                            Date
                            <span class="cursor-pointer" wire:click="switchDateOrder()"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                        </svg></span>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3">Heure début</th>
                    <th scope="col" class="px-4 py-3">Heure fin</th>
                    <th scope="col" class="px-4 py-3">Candidat</th>
                    <th scope="col" class="px-4 py-3">Type de leçon</th>
                    <th scope="col" class="px-4 py-3">Véhicule</th>
                    <th scope="col" class="px-4 py-3">Statut</th>
                    <th scope="col" class="px-4 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody class="grow">
                @define $currentDate = null
                @forelse ($lecons as $lecon)
                    @if ($currentDate != $lecon->date_reservation)
                        @define $currentDate = $lecon->date_reservation
                        <tr class="bg-gray-50 dark:bg-gray-900">

                            <th scope="row" colspan="9"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $lecon->date_reservation->isoFormat('dddd D/MM/Y') }}</th>
                        </tr>
                    @endif
                    <tr class="border-b dark:border-gray-700 h-16 ">
                        <th class="px-4 py-3">{{ $lecon->id }}</th>
                        <td class="px-4 py-3">{{ $lecon->date_reservation->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">{{ $lecon->heure_debut }}</td>
                        <td class="px-4 py-3">{{ $lecon->heure_fin }}</td>
                        <td class="px-4 py-3"> <a class="hover:text-gray-400 hover:dark:text-gray-300"
                                href="{{ route('candidats.profile', ['candidat' => $lecon->candidat->id ]) }}">
                                {{ $lecon->candidat->fullname }} </a></td>
                        <td class="px-4 py-3">{{ $lecon->getType()->toString() }}</td>
                            
                        @if($lecon->getType() == App\Enums\TypeLeconEnum::CONDUITE_FORMULE ||  $lecon->getType() == App\Enums\TypeLeconEnum::CONDUITE_SUPPLEMENTAIRE)
                            <td class="px-4 py-3 ">{{ $lecon->leconConduite->plaque_imm }}</td>
                        @else
                            <td class="px-4 py-3">Pas de voiture</td>
                        @endif
                        <td class="px-4 py-3 {{ $lecon->statut->id->getColor() }}">{{ $lecon->statut->statut }}</td>
                        <td class="px-4 py-3">
                            @if ($lecon->statut_id == StatutEnum::ATTENTE->value)
                                <div class="flex items-center justify-end content-center h-full">
                                    <div class="py-1 text-sm flex">
                                        <button type="button" wire:click="deny({{ $lecon->id }})"
                                            class="mx-1 flex  items-center py-2 px-4 rounded bg-red-500 dark:bg-red-700 hover:bg-red-300 dark:hover:bg-red-500 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                            Refuser
                                        </button>
                                        <button type="button" wire:click="tryAccept({{ $lecon->id }}) "
                                            class="mx-1 flex  items-center py-2 px-4 rounded bg-green-500 dark:bg-green-700 hover:bg-green-300 dark:hover:bg-green-500 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                            Accepter
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-center">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            colspan="9"
                            >
                            Vous n'avez aucune leçon
                        </th>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @include('livewire.confirm-accept-lecon')
    </div>
    <div class="flex justify-center mt-5">
        {{ $lecons->links('pagination.custom-livewire') }}
    </div>
</div>
