<footer class="bg-white rounded-lg shadow dark:bg-gray-900 m-4">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="{{ route('home') }}" class="flex items-center mb-4 sm:mb-0">
                <img class="md:h-10 h-6 w-auto" src="{{ Vite::asset('resources/images/logo/logo.svg') }}" alt="">
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                <li>
                    <button data-modal-target="theme-modal" data-modal-toggle="theme-modal" class="hover:underline me-4 md:me-6">
                        <i class="fa-regular fa-sun"></i>
                        Theme
                    </button>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© {{ date('Y') }} <a href="#" class="hover:underline">{{ config('app.name') }}</a>. All Rights Reserved.</span>
    </div>
</footer>

<!--  Modal  -->
@include('modals.theme-modal')
