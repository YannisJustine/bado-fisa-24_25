@extends('layouts.main')

@section('title')
    Accueil
@endsection

@section('content')
<div class="w-full h-full flex flex-col md:flex-row items-center justify-center">
    @auth('candidat')
        <x-card href="{{ route('catalogue') }}"  img="{{ Vite::asset('resources/images/home/catalogue.jpg') }}" title="Catalogue">
            Catalogue des formations
        </x-card>
    @endauth
    @auth
        @role('admin')
            <x-card href="{{ route('calendrier') }}" img="{{ Vite::asset('resources/images/home/calendrier.jpg') }}" title="Calendrier">
                Calendrier des leçons
            </x-card>
        @elserole('formateur')
            <x-card href="{{ route('formateur') }}" img="{{ Vite::asset('resources/images/home/calendrier.jpg') }}" title="Tableau">
                Tableau de bord
            </x-card>
        @endrole
    @endauth
</div>

@endsection
