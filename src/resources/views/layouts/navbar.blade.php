<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white "
                    aria-controls="menu" aria-expanded="false"
                    data-collapse-toggle="menu">
                    <span class="sr-only">Open main menu</span>

                    <svg id="iconeOuverte" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg id="iconeFermee" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex flex-shrink-0 items-center">
                    <a href="{{ route('home') }}">
                        <img class="md:h-8 h-6 w-auto" src="{{ Vite::asset('resources/images/logo/RoulerMalin.svg') }}"
                            alt="Your Company">
                    </a>
                </div>
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex item-center space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        @auth('candidat')
                        <x-navigation.link href="{{ route('catalogue') }}"> Catalogue </x-navigation.link>
                        @endauth
                        @role('admin')
                        <x-navigation.link href="{{ route('calendrier') }}"> Calendrier </x-navigation.link>
                        @elserole('formateur')
                        <x-navigation.link href="{{ route('candidats') }}"> Candidats </x-navigation.link>
                        @endrole
                    </div>
                </div>
            </div>
            <div class="absolute right-0 md:block">
                @php
                $isGuest = Auth::guard('web')->guest() && Auth::guard('candidat')->guest();
                @endphp
                @if($isGuest)
                <x-link-button href="{{ route('login.candidat') }}" class="hidden md:block md:py-2 md:px-3 px-1 py-1 bg-orange-600 dark:hover:bg-orange-800 dark:hover:text-white">
                    Se connecter
                </x-link-button>
                @else
                <div class="relative ml-3">
                    <div>
                        <button type="button"
                            class="relative flex rounded-full bg-logo-orange-600 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-orange-800"
                            id="user-menu-button" aria-expanded="false" aria-haspopup="true"
                            data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom-end">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">Open user menu</span>
                            <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-orange-100 rounded-full dark:bg-orange-600">
                                <span class="font-medium text-orange-600 dark:text-white">{{ getAuthUser()->initials }}</span>
                            </div>
                        </button>
                    </div>

                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-orange-100 rounded-lg shadow dark:bg-orange-700 dark:divide-orange-600"
                        id="user-dropdown">
                        <div class="px-4 py-3">
                            <span class="block text-sm text-orange-900 dark:text-white">{{ getAuthUser()->fullname }}</span>
                            <span
                                class="block text-sm  text-orange-500 truncate dark:text-gray-100">{{ getAuthUser()->email }}</span>
                        </div>
                        <ul class="py-2" aria-labelledby="user-menu-button">
                            @auth('web')
                            @role('formateur')
                            <li>
                                <a href="{{ (Route::currentRouteName() != 'formateur') ? route('formateur') : '#' }}"
                                    class="block px-4 py-2 text-sm text-orange-700 hover:bg-orange-100 dark:hover:bg-orange-600 dark:text-orange-200 dark:hover:text-white">Tableau de bord</a>
                            </li>
                            @endrole
                            @endauth
                            @auth('candidat')
                            <li>
                                <a href="{{ route('candidats.profile', ['candidat' => getAuthUser()->id ]) }}"
                                    class="block px-4 py-2 text-sm text-orange-700 hover:bg-orange-100 dark:hover:bg-orange-600 dark:text-orange-200 dark:hover:text-white">Profil</a>
                            </li>
                            @endauth
                            <li>
                                <a href="{{ route('logout') }}"
                                    class="block px-4 py-2 text-sm text-orange-700 hover:bg-orange-100 dark:hover:bg-orange-600 dark:text-orange-200 dark:hover:text-white">Se déconnecter
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-orange-100 rounded-lg shadow dark:bg-orange-700 dark:divide-orange-600"
                    id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-orange-900 dark:text-white">{{ getAuthUser()->fullname }}</span>
                        <span
                            class="block text-sm  text-orange-500 truncate dark:text-gray-100">{{ getAuthUser()->email }}</span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        @auth('web')
                        <li>
                            <a href=" {{ (Route::currentRouteName() != 'formateur') ? route('formateur') : '#' }} "
                                class="block px-4 py-2 text-sm text-orange-700 hover:bg-orange-100 dark:hover:bg-orange-600 dark:text-orange-200 dark:hover:text-white">Tableau de bord</a>
                        </li>
                        @endauth
                        <li>
                            <a href="{{ route('logout') }}"
                                class="block px-4 py-2 text-sm text-orange-700 hover:bg-orange-100 dark:hover:bg-orange-600 dark:text-orange-200 dark:hover:text-white">Se déconnecter
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
    </div>
    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="hidden" id="menu">
        <ul class="flex flex-col font-medium mt-4 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700">

            @auth('candidat')
            <x-navigation.link href="{{ route('catalogue') }}"> Catalogue </x-navigation.link>
            @endauth
            @auth('web')
            <x-navigation.link href="{{ route('candidats') }}"> Candidats </x-navigation.link>
            @endauth

            @if($isGuest)
            <x-navigation.link href="{{ route('login.candidat') }}" class="md:py-2 md:px-3 px-1 py-1 bg-orange-600 dark:hover:bg-orange-800 dark:hover:text-white">
                Se connecter
            </x-navigation.link>
            @endif
        </ul>

    </div>
</nav>