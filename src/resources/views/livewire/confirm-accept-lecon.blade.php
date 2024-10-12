<x-modal wire:model="openModal" class="bg-red-700 bg-opacity-50">
    <div class="w-full h-full p-4">
        <div class="text-center text-red-500">
            <h2 class="text-4xl font-bold leading-9 tracking-tight text-shadow-sm shadow-black">Attention</h2>
            <p class="mt-2 text-xl text-red-500"> 
                Il y a <span class="font-bold">{{ $count }}</span> autre(s) leçon(s) sur ce créneau. <br>
                En validant la leçon, vous allez refuser les autres leçons. <br>
                Voulez vous validez ? 
            </p>
            <div class="my-5">
                <button wire:click="validateCurrentLecon()" class="mx-1 py-2 px-4 rounded bg-red-500 dark:bg-red-700 hover:bg-red-300 dark:hover:bg-red-500 dark:hover:text-white text-red-700 dark:text-gray-200 ">Valider</button>
                <button wire:click="close()" class="mx-1 py-2 px-4 rounded bg-gray-500 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-500 dark:hover:text-white text-gray-700 dark:text-gray-200">Refuser</button>
            </div>
        </div>
    </div>
</x-modal>