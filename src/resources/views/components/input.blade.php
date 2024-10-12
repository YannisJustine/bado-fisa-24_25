
<div class="relative z-0 w-full mb-5 group">
    <input id="{{ $name }}" {{ $attributes->except('class', 'name') }} class="block py-2.5 px-0 w-full text-sm autofill:bg-transparent text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-logo-orange-500 focus:outline-none focus:ring-0 focus:border-logo-orange-600 peer" placeholder=" "/>
    <label for="{{ $name }}" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-logo-orange-600 peer-focus:dark:text-logo-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ $label }}</label>
    @error($name)
        <p class="text-red-500 text-xs italic mt-4">
            {{ $message }}
        </p>
    @enderror
</div>
