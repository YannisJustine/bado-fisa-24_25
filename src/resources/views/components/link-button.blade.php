@props([
    $color = $color ?? ''
])


<a href="{{ $attributes['href'] }}" {{ $attributes->merge(['class' => 'rounded-xl px-5 py-2.5 text-sm  dark:text-white dark:hover:text-gray-500 focus:ring-4 focus:outline-none focus:ring-gray-700 ']) }}>
    {{ $slot }}
</a>
