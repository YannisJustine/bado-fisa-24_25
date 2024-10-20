<div
    class="m-8 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <a href="{{ $link }}">
        <img class="rounded-t-lg w-full h-48 object-cover" src="{{ Vite::asset('resources/images/catalog/' . $id . '.jpg') }}" alt="image" style="width: 100%;" />
    </a>
    <div class="p-5">
        <a href="{{ $link }}">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ $libelle }}</h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Prix:
            {{ $prix }}€</p>
        <a href="{{ $link }}"
            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-logo-orange-700 rounded-lg hover:bg-logo-orange-800 focus:ring-4 focus:outline-none focus:ring-logo-orange-300 dark:bg-logo-orange-600 dark:hover:bg-logo-orange-700 dark:focus:ring-logo-orange-800">
            {{ $button }}
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
            </svg>
        </a>
    </div>
</div>