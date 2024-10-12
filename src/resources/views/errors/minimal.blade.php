<!DOCTYPE html>
<html lang="fr"  data-fr-scheme="system">
<head>
    @yield('meta')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @vite(['resources/js/app.js'])

    <title>@yield('title')</title>

    <script>
        if (localStorage.getItem('dark-mode') === 'true' || (!('dark-mode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
    <body class="flex flex-col h-screen dark:bg-gray-900 overflow-hidden" >
        <div class="h-full flex justify-center align-content-center" id="app">
            <div class="px-10 py-12 mx-auto text-gray-800 dark:text-white text-center">
                <div class="md:max-w-xl">
                    <section class="bg-white dark:bg-gray-900">
                        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                            <div class="mx-auto max-w-screen-sm text-center">
                                <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-ensiie-main-600 dark:text-ensiie-main-500">@yield('code')</h1>
                                <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">@yield('header')</p>
                                <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">@yield('message')</p>
                                <a href="{{ route('home') }}" class="inline-flex text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-900 my-4">Back to Homepage</a>
                            </div>   
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>
