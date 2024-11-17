<!DOCTYPE html>
<html lang="fr" data-fr-scheme="system">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ Vite::asset('resources/images/logo/RoulerMalin.svg') }}" type="image/svg+xml">
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/js/app.js'])
    @yield('meta')
    <title>@yield('title')</title>
	<script>
        if (localStorage.getItem('dark-mode') === 'true' || (!('dark-mode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

@yield('body')

@stack('scripts')

</html>
