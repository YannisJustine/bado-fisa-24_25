@extends('layouts.main')

@section('title')
Catalogue
@endsection

@section('content')
<div class="container h-full mx-auto flex flex-col md:flex-row flex-wrap justify-evenly items-center gap-4">
    <x-card href="{{ route('catalogue.formules') }}" img="{{ Vite::asset('resources/images/formules.jpg') }}" title="Formules">
        Voir les formules
    </x-card>

    <x-card href="{{ route('catalogue.heures_supp') }}" img="{{ Vite::asset('resources/images/heures-supp.jpg') }}" title="Heures supplémentaires">
        Voir les heures supplémentaires
    </x-card>
    </div>


</div>

@endsection