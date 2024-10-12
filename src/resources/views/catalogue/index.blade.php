@extends('layouts.main')

@section('title')
    Catalogue
@endsection

@section('content')
<div class="container mx-auto flex flex-row flex-wrap justify-evenly flex-1 items-center">
    <div class="m-8 w-full max-w-sm flex flex-col bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="{{ route('catalogue.formules') }}">
            <img class="rounded-t-lg" src="https://placehold.co/600x400" alt="image" />
        </a>
        <div class="p-5">
            <a href="{{ route('catalogue.formules') }}" class="inline-flex items-center px-3 py-2 mt-5 text-sm font-medium text-center text-white bg-logo-orange-700 rounded-lg hover:bg-logo-orange-800 focus:ring-4 focus:outline-none focus:ring-logo-orange-300 dark:bg-logo-orange-600 dark:hover:bg-logo-orange-700 dark:focus:ring-logo-orange-800">
                Voir les formules
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
        </div>
    </div>

    <div class="m-8 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="{{ route('catalogue.heures_supp') }}">
            <img class="rounded-t-lg" src="https://placehold.co/600x400" alt="image" />
        </a>
        <div class="p-5">
            <a href="{{ route('catalogue.heures_supp') }}" class="inline-flex items-center px-3 py-2 mt-5 text-sm font-medium text-center text-white bg-logo-orange-700 rounded-lg hover:bg-logo-orange-800 focus:ring-4 focus:outline-none focus:ring-logo-orange-300 dark:bg-logo-orange-600 dark:hover:bg-logo-orange-700 dark:focus:ring-logo-orange-800">
                Voir les heures supplémentaires
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
        </div>
    </div>
    
        
</div>

@endsection
