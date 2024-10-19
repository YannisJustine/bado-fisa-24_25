@extends('layouts.main')

@section('title')
    Accueil
@endsection

@section('content')
<div class="w-full flex-1 grid grid-cols-3 gap-4 content-center justify-items-center">
    @auth('candidat')
        <x-card href="{{ route('catalogue') }}"  img="{{ Vite::asset('resources/images/home/catalogue.jpg') }}" title="Catalogue">
            Catalogue des formations
        </x-card>
    @endauth
    @auth
        <x-card href="{{ route('calendrier') }}" img="{{ Vite::asset('resources/images/home/calendrier.jpg') }}" title="Calendrier">
            Calendrier des leçons
        </x-card>
    @endauth
</div>

@endsection
