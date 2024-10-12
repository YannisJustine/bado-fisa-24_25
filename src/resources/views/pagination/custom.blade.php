
@if ($paginator->hasPages())
    <nav role="navigation" class="fr-pagination" aria-label="Pagination">
        <ul class="inline-flex -space-x-px text-sm">
            @if ($paginator->onFirstPage())
                <li>
                    <a class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" disabled="true" role="link">
                        Première page
                    </a>
                </li>
                <li>
                    <a class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" disabled="true" role="link" >
                        Page précédente
                    </a>
                </li>
            @else
                <li>
                    <a class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="{{ $paginator->url(1) }}" role="link">
                        Première page
                    </a>
                </li>
                <li>
                    <a class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="{{ $paginator->previousPageUrl() }}" aria-disabled="true" role="link">
                        Page précédente
                    </a>
                </li>
            @endif
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <a class="flex items-center justify-center px-4 h-10 text-logo-orange-600 border border-gray-300 bg-logo-orange-50 hover:bg-logo-orange-100 hover:text-logo-orange-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white" title="Page 1">
                            {{ $element }}
                        </a>
                    </li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><a class="flex items-center justify-center px-4 h-10 text-logo-orange-600 border border-gray-300 bg-logo-orange-50 hover:bg-logo-orange-100 hover:text-logo-orange-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"  aria-current="page" title="Page {{ $page }}">{{ $page }}</a></li>
                        @else
                            <li><a class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="{{ $paginator->url($page) }}" title="Page {{ $page }}">{{ $page  }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <li>
                    <a class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="{{ $paginator->nextPageUrl() }}" aria-disabled="true" >
                        Page suivante
                    </a>
                </li>
                <li>
                    <a class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="{{ $paginator->url($paginator->lastPage()) }}" aria-disabled="true">
                        Dernière page
                    </a>
                </li>
            @else
                <li>
                    <a class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" aria-disabled="true" >
                        Page suivante
                    </a>
                </li>
                <li>
                    <a class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" aria-disabled="true">
                        Dernière page
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
