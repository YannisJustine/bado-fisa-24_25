@props(['id', 'maxWidth', 'model'])

@php
$id = $id ?? md5($attributes->wire('model'));

$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth ?? '2xl'];
$model = $model ?? false;
@endphp

<div
    x-data="{ show: @if(!$model) @entangle($attributes->wire('model'))   @else {{ $model }} @endif }"
    x-on:close.stop="show = false;"
    x-on:keydown.escape.window="show = false;"
    x-show="show"
    @if($model)
        x-init="$watch('{{ $model }}', value => { show = {{ $model }} })"
    @endif
    class="bg-gray-900 bg-opacity-50 dark:bg-opacity-80 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 max-h-full"
    style="display: none;"
>
    <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false; @if($model) {{ $model }} = false @endif" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
    </div>

    <div x-show="show" {{ $attributes->merge(["class" => "mb-6 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full ".$maxWidth." sm:mx-auto"]) }}
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        {{ $slot }}
    </div>
</div>