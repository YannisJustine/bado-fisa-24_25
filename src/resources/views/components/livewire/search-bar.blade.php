<div>
    <label for={{ $name ?? "default-search" }} class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input type="search" wire:model.defer="searchField" wire:keydown.enter="dispatchSearch" wire:loading.attr="disabled" name="{{ $name ?? "default-search" }}" id={{ $name ?? "default-search"  }} class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-logo-orange-500 focus:border-logo-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
            placeholder="{{ $placeholder ?? "Rechercher" }}" required wire:loading.attr="disabled" autocomplete="off">
        <button wire:click="dispatchSearch" wire:loading.delay.attr="disabled" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-logo-orange-700 rounded-e-lg border border-logo-orange-700 hover:bg-logo-orange-800 hover:border-logo-orange-800">Rechercher</button>
    </div>
</div>
