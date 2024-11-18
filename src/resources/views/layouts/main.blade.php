@extends('layouts.app')

@section('body')

<body class="flex flex-col h-screen dark:bg-gray-900 {{ $class ?? "" }}">
    @include('layouts.navbar')
    @include('components.breadcrumb')
    @if(session()->has('error'))
    <div class="mt-10 sm:mx-auto sm:w-full bg-red-700 bg-opacity-20 sm:max-w-lg sm:p-5">
        <div class="text-center text-red-500">
            <h2 class="text-2xl font-bold leading-9 tracking-tight text-shadow-sm shadow-black">Erreur</h2>
            <p class="mt-2 text-sm text-red-500"> {{ session('error') }}</p>
        </div>
    </div>
    @elseif(session()->has('success'))
    <div class="mt-10 sm:mx-auto sm:w-full bg-green-700 bg-opacity-20 sm:max-w-lg sm:p-5">
        <div class="text-center text-green-500">
            <h2 class="text-2xl font-bold leading-9 tracking-tight text-shadow-sm shadow-black">Succès</h2>
            <p class="mt-2 text-sm text-green-500"> {{ session('success') }}</p>
        </div>
    </div>
    @endif
    <div class="grow flex flex-col" id="app">
        @yield('content')
    </div>

    @include('layouts.footer')
    @yield('livewire-body')
</body>
@endsection