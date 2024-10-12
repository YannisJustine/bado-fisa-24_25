@extends('layouts.livewire')

@section('title')
    Profil du Formateur
@endsection

@section('content')
    <div class="flex lg:flex-row flex-col grow my-10">
        @include('formateur.tab')
        @include('formateur.panel')
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/tabs.js'])
@endpush
