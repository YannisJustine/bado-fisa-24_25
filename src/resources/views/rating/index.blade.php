@extends('layouts.main')
@section('title', 'Commentaires')
@section('content')
    @if ($errors->any())
        <div id="error-banner" class="flex justify-between w-full p-4 border-b bg-red-700 border border-red-400 text-red-200">
            <div class="flex items-center mx-auto">
                <p class="flex items-center text-sm font-normal">
                    <span> Un problème est survenu lors de la soumission du formulaire.</span>
                </p>
            </div>
            <div class="flex items-center">
                <button data-dismiss-target="#error-banner" type="button" class="flex-shrink-0 inline-flex justify-center w-7 h-7 items-center text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close banner</span>
                </button>
            </div>
        </div>
    @endif
    <section class="bg-white py-8 antialiased dark:bg-gray-900 mx-auto container">
        <div class="px-10 2xl:px-0">
            <div class="flex items-center gap-2">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Commentaires</h2>

                <div class="mt-2 flex items-center gap-2 sm:mt-0">
                    <div class="flex items-center gap-0.5">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= floor($stats['averageRating']))
                                <!-- Étoile pleine -->
                                <svg class="h-4 w-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                </svg>
                            @elseif ($i == ceil($stats['averageRating']) && $stats['averageRating'] != floor($stats['averageRating']))
                                <!-- Étoile moitié pleine (partielle) -->
                                <svg class="h-4 w-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2L9.09 8.26l-6.91-.53C1.05 7.49.97 9.34 2.28 10.14l5.51 4.8-1.22 6.89c-.15.85.73 1.51 1.55 1.1l6.14-3.24 6.14 3.24c.82.42 1.7-.25 1.55-1.1l-1.22-6.89 5.51-4.8c1.31-.8 1.23-2.65-.37-2.91l-6.91.53L12 2z" />
                                </svg>
                            @else
                                <!-- Étoile vide -->
                                <svg class="h-4 w-4 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                </svg>
                            @endif
                        @endfor
                    </div>
                    <p class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400">
                        ({{ $stats['averageRating'] }})
                    </p>
                    <a href="#"
                        class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline dark:text-white">
                        {{ $stats['totalComments'] }} </a>
                </div>
            </div>

            <div class="my-6 gap-8 sm:flex sm:items-start md:my-8">
                <div class="shrink-0 space-y-4">
                    <p class="text-2xl font-semibold leading-none text-gray-900 dark:text-white">
                        {{ $stats['averageRating'] }} sur 5</p>
                    @auth('candidat')
                        <button type="button" data-modal-target="review-modal" data-modal-toggle="review-modal"
                        id="open-modal-btn"
                        class="mb-2 me-2 rounded-lg bg-gray-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Écrire un commentaire</button>
                    @endauth
                </div>

                <div class="mt-6 min-w-0 flex-1 space-y-3 sm:mt-0">
                    <div class="flex items-center gap-2">
                        <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">5
                        </p>
                        <svg class="h-4 w-4 shrink-0 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                            <div class="h-1.5 rounded-full bg-yellow-300"
                                style="width: {{ $stats['totalComments'] ? ($stats['ratings'][5] / $stats['totalComments']) * 100 : 0 }}%">
                            </div>

                        </div>
                        <a href="#"
                            class="w-8 shrink-0 text-right text-sm font-medium leading-none text-gray-700 hover:underline dark:text-gray-500 sm:w-auto sm:text-left">{{ $stats['ratings'][5] ?? 0 }}
                            <span class="hidden sm:inline">avis</span></a>
                    </div>

                    <div class="flex items-center gap-2">
                        <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">4
                        </p>
                        <svg class="h-4 w-4 shrink-0 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                            <div class="h-1.5 rounded-full bg-yellow-300"
                                style="width: {{ $stats['totalComments'] ? ($stats['ratings'][4] / $stats['totalComments']) * 100 : 0 }}%">
                            </div>
                        </div>
                        <a href="#"
                            class="w-8 shrink-0 text-right text-sm font-medium leading-none text-gray-700 hover:underline dark:text-gray-500 sm:w-auto sm:text-left">{{ $stats['ratings'][4] ?? 0 }}
                            <span class="hidden sm:inline">avis</span></a>
                    </div>

                    <div class="flex items-center gap-2">
                        <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">3
                        </p>
                        <svg class="h-4 w-4 shrink-0 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                            <div class="h-1.5 rounded-full bg-yellow-300"
                                style="width: {{ $stats['totalComments'] ? ($stats['ratings'][3] / $stats['totalComments']) * 100 : 0 }}%">
                            </div>
                        </div>
                        <a href="#"
                            class="w-8 shrink-0 text-right text-sm font-medium leading-none text-gray-700 hover:underline dark:text-gray-500 sm:w-auto sm:text-left">{{ $stats['ratings'][3] ?? 0 }}
                            <span class="hidden sm:inline">avis</span></a>
                    </div>

                    <div class="flex items-center gap-2">
                        <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">2
                        </p>
                        <svg class="h-4 w-4 shrink-0 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                            <div class="h-1.5 rounded-full bg-yellow-300"
                                style="width: {{ $stats['totalComments'] ? ($stats['ratings'][2] / $stats['totalComments']) * 100 : 0 }}%">
                            </div>
                        </div>
                        <a href="#"
                            class="w-8 shrink-0 text-right text-sm font-medium leading-none text-gray-700 hover:underline dark:text-gray-500 sm:w-auto sm:text-left">{{ $stats['ratings'][2] ?? 0 }}
                            <span class="hidden sm:inline">avis</span></a>
                    </div>

                    <div class="flex items-center gap-2">
                        <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">1
                        </p>
                        <svg class="h-4 w-4 shrink-0 text-yellow-300" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                            <div class="h-1.5 rounded-full bg-yellow-300"
                                style="width: {{ $stats['totalComments'] ? ($stats['ratings'][1] / $stats['totalComments']) * 100 : 0 }}%">
                            </div>
                        </div>
                        <a href="#"
                            class="w-8 shrink-0 text-right text-sm font-medium leading-none text-gray-700 hover:underline dark:text-gray-500 sm:w-auto sm:text-left">{{ $stats['ratings'][1] ?? 0 }}
                            <span class="hidden sm:inline">avis</span></a>
                    </div>
                </div>
            </div>

            <div class="mt-6 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($comments as $comment)
                    <div class="gap-3 pb-6 sm:flex sm:items-start">
                        <div class="shrink-0 space-y-2 sm:w-48 md:w-72">
                            <div class="flex items-center gap-0.5">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $comment['rating'])
                                        <svg class="h-4 w-4 text-yellow-300" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                        </svg>
                                    @else
                                        <svg class="h-4 w-4 text-gray-300" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                        </svg>
                                    @endif
                                @endfor
                            </div>

                            <div class="space-y-0.5">
                                <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $comment['user']->nom }}
                                </p>
                                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $comment['created_at'] }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 min-w-0 flex-1 space-y-4 sm:mt-0">
                            <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{ $comment['comment'] }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">No reviews found</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- pagination centree--}}
        <div class="flex justify-center mt-8">
            {{ $comments->links('pagination.custom') }}
        </div>
        
    </section>

    <!-- Add review modal -->
    <div id="review-modal" tabindex="-1" aria-hidden="true"
        class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 antialiased">
        <div class="relative max-h-full w-full max-w-2xl p-4">
            <!-- Modal content -->
            <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-700 md:p-5">
                    <h3 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">Ajouter un avis</h3>
                    <button type="button"
                        class="absolute right-5 top-5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="review-modal">
                        <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
        
                <form method="POST" action="{{ route('rating.store') }}" class="p-4 md:p-5">
                    @csrf
                    <div class="mb-4 grid grid-cols-2 gap-4">
                        @foreach ($errors->all() as $error)
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $error }}
                            </p>
                        @endforeach
                        <div class="col-span-2">
                            <div class="flex items-center" id="rating-stars">
                                <svg id="rating-1" class="h-6 w-6 cursor-pointer text-gray-300"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg id="rating-2" class="h-6 w-6 cursor-pointer text-gray-300"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg id="rating-3" class="h-6 w-6 cursor-pointer text-gray-300"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg id="rating-4" class="h-6 w-6 cursor-pointer text-gray-300"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg id="rating-5" class="h-6 w-6 cursor-pointer text-gray-300"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                            </div>

                            <div id="rating">
                                <span class="ms-2 text-lg font-bold text-gray-900 dark:text-white" >0 sur 5</span>
                                <input type="text" name="rating" hidden value="0">
                            </div>
                        </div>
                        <div class="col-span-2">
                            <label for="description"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Review
                                description</label>
                            <textarea id="description" rows="6" name="comment"
                                class="mb-2 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-gray-500 focus:ring-gray-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-gray-500 dark:focus:ring-gray-500"
                                required=""></textarea>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 pt-4 dark:border-gray-700 md:pt-5">
                        <button type="submit"
                            class="me-2 inline-flex items-center rounded-lg bg-gray-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Add
                            review</button>
                        <button type="button" data-modal-toggle="review-modal"
                            class="me-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const stars = document.querySelectorAll('#rating-stars svg');
            const modalTrigger = document.getElementById('open-modal-btn');
            const ratingText = document.querySelector('#rating span');
            const ratingInput = document.querySelector('#rating input');

            let selectedRating = 0;

            modalTrigger.addEventListener('click', () => {
                setTimeout(() => {
                    stars.forEach((star, index) => {
                        star.addEventListener('click', () => {
                            selectedRating = index + 1;
                            updateStars(selectedRating);
                        });
                    });
                }, 100);

                function updateStars(rating) {
                    stars.forEach((star, i) => {
                        if (i < rating) {
                            star.classList.add('text-yellow-400');
                            star.classList.remove('text-gray-300');
                        } else {
                            star.classList.add('text-gray-300');
                            star.classList.remove('text-yellow-400');
                        }
                    });
                    ratingText.textContent = `${rating} sur 5`;
                    ratingInput.value = rating;
                }
            });
        });
    </script>
@endpush
