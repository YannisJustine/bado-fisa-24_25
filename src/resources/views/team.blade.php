@extends('layouts.main')


@section('content')
    <div class="py-4 px-2 mx-auto md:py-14 md:px-4 max-w-screen-xl">
        <div class="mb-4 md:mb-16 text-center">
            <h1 class="text-2xl font-bold text-center dark:text-white text-gray-800 md:text-4xl mb-2 md:mb-4">Team</h1>
            <p class="md:text-xl text-gray-300 font-light">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.</p>

        </div>
        <div class="grid gap-4 md:gap-8 md:grid-cols-2 items-center">
            <div class="rounded-lg bg-gray-800 sm:flex items-center">
                <svg class="w-48 h-48 py-2 px-2 text-gray-800 dark:text-white bg-slate-500 rounded-l-lg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 18">
                    <path d="M7 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm2 1H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                </svg>
                <div class="p-5">
                    <h2 class="text-xl font-bold text-white mb-2 md:mb-4">Lucas JUSTINE</h2>
                    <p class=" text-white dark:text-gray-400">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.</p>
                </div>
            </div>
            <div class="rounded-lg bg-gray-800 sm:flex items-center">
                <svg class="w-48 h-48 py-2 px-2 text-gray-800 dark:text-white bg-slate-500 rounded-l-lg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 18">
                    <path d="M7 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm2 1H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                </svg>
                <div class="p-5">
                    <h2 class="text-xl font-bold text-white mb-2 md:mb-4">Yannis JUSTINE</h2>
                    <p class=" text-white dark:text-gray-400">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.</p>
                </div>
            </div>
            <div class="rounded-lg bg-gray-800 sm:flex items-center">
                <svg class="w-48 h-48 py-2 px-2 text-gray-800 dark:text-white bg-slate-500 rounded-l-lg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 18">
                    <path d="M7 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm2 1H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                </svg>
                <div class="p-5">
                    <h2 class="text-xl font-bold text-white mb-2 md:mb-4">Mattieu PERESSONI </h2>
                    <p class=" text-white dark:text-gray-400">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.</p>
                </div>
            </div>
        </div>
    </div>
@endsection