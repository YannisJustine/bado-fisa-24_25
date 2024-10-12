@extends('errors::minimal')

@section('title', __("Service Unavailable"))
@section('code', '503')
@section('message', __($exception->getMessage()))
@section('chapo')
<p>{{ __("Please try again later, you'll soon be able to use the service again") }}</p>
@endsection