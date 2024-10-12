<div>
    <x-table>
        <x-slot name="header">
            <x-table.header>Type d'heure</x-table.header>
            <x-table.header>Date</x-table.header>
            <x-table.header>Heure de début</x-table.header>
            <x-table.header>Heure de fin</x-table.header>
            <x-table.header>Statut</x-table.header>
        </x-slot>
        <x-slot name="body">
            @define $currentDate = null
            @forelse ($lecons as $heurePlanifiee)
                @if($currentDate != $heurePlanifiee->date_reservation)
                    <x-table.row class="bg-gray-50 dark:bg-gray-900 ">
                        <x-table.cell colspan="5" class=" text-gray-900 whitespace-nowrap dark:text-white">
                           Leçons du {{ $heurePlanifiee->date_reservation->isoFormat('dddd D/MM/Y') }}
                        </x-table.cell>
                    </x-table.row>
                    @define $currentDate = $heurePlanifiee->date_reservation
                @endif
                <x-table.row>
                    @if($heurePlanifiee->getType() == App\Enums\TypeLeconEnum::CONDUITE_FORMULE ||  $heurePlanifiee->getType() == App\Enums\TypeLeconEnum::CONDUITE_SUPPLEMENTAIRE)
                        <x-table.cell>Lecon de conduite</x-table.cell>
                    @else
                        <x-table.cell>Lecon d'accompagnement</x-table.cell>
                    @endif
                    <x-table.cell>{{ $heurePlanifiee->date_reservation->format('d/m/Y') }}</x-table.cell>
                    <x-table.cell>{{ $heurePlanifiee->heure_debut }}</x-table.cell>
                    <x-table.cell>{{ $heurePlanifiee->heure_fin }}</x-table.cell>
                    <x-table.cell class="{{ $heurePlanifiee->statut->id->getColor() }}">{{ $heurePlanifiee->statut->statut }}</x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="5" class="text-center">
                        <span class="text-gray-500">Aucune heure planifiée</span>
                    </x-table.cell>
                </x-table.row>
            @endforelse
        </x-slot>
    </x-table>


    <div class="flex justify-center mt-5">
        {{ $lecons->links('pagination.custom-livewire') }}
    </div>    
</div>