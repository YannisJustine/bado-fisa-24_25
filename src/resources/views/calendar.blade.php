@extends('layouts.main')

@section('title', 'Calendrier')

@section('content')
    {{-- <div class="max-w-4xl mx-auto dark:text-slate-400 py-5">
        <div id="calendar"></div>
    </div> --}}
    <div class="mt-10 mb-4">
        <Suspense>
            <template #default>
                <Calendar />
            </template>
            <!-- loading state via #fallback slot -->
            <template #fallback>
                <div class="flex items-center">
                    <div role="status"
                    class=" mx-auto max-w-lg p-4 border border-gray-200 rounded shadow animate-pulse md:p-6 dark:border-gray-700">
                    <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-32 mb-2.5"></div>
                    <div class="w-48 h-2 mb-10 bg-gray-200 rounded-full dark:bg-gray-700"></div>

                    <div class="grid grid-cols-5 gap-4">
                        <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                        <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                        <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                        <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                        <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                        <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                        <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                        <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                        <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                        <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                        <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                        <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                        <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                        <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                        <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>

                    </div>
                </div>
                </div>
                
            </template>
        </Suspense>

    </div>
@endsection

{{-- 
@push('scripts')
    @vite(['resources/js/calendar.js'])
@endpush --}}
