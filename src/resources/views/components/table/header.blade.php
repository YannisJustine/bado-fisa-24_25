@props([
    'sortable' => null,
    'direction' => null
])

<th {{ $attributes->merge(['class' => "px-6 py-3"]) }}>

    @unless($sortable)
        <span>
            {{ $slot }}
        </span>
    @else
        <button {{ $attributes->except('class') }} class="flex items-center text-left leading-4 space-x-4">
            <span>
                {{ $slot }}
            </span>

            @if($direction == "asc")
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7 7.674 1.3a.91.91 0 0 0-1.348 0L1 7"/>
                </svg>
            @elseif($direction == "desc")
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1"/>
                </svg>
            @else
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l5.326 5.7a.909.909 0 0 0 1.348 0L13 1"/>
                </svg>
            @endif
        </button>
    @endunless

</th>
