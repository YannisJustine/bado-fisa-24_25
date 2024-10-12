@props([
    'href' => "#",
    'current' => false
])


@if(str_starts_with(Request::url(), $href))
    <span {{ $attributes->merge(['class' => "block py-2 px-3 md:p-0 text-logo-orange-500 font-semibold"]) }}>
        {{ $slot }}
    </span>
@else
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "block py-2 px-3 md:p-0 dark:text-white text-gray-900 dark:hover:text-logo-orange-300 hover:text-logo-orange-300"]) }}>
        {{ $slot }}
    </a>
@endif