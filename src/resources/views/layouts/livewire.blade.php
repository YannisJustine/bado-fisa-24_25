@extends('layouts.main')

@section("title") {{ $title ?? "" }} @endsection

@section("meta")
    @livewireStyles
@endsection


@section("livewire-body")
    @livewireScripts
@endsection
