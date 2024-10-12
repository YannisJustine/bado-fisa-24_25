<div {{ $attributes->merge(['class' => "py-5"]) }}>
    <ul class=" divide-y divide-gray-200 dark:divide-gray-700">
        {{ $slot }}
    </ul>
</div>
