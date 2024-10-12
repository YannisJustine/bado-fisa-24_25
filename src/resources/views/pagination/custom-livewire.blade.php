<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination">
            <ul class="inline-flex -space-x-px text-sm">
                @if ($paginator->onFirstPage())
                    <li>
                        <a class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" aria-disabled="true" role="link">
                            Première page
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" aria-disabled="true" role="link" >
                            Page précédente
                        </a>
                    </li>
                @else
                    <li>
                        <button
                            class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                            wire:click="setPage(1,'{{ $paginator->getPageName() }}')" role="link">
                            Première page
                        </button>
                    </li>
                    <li>
                        <button
                            class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                            aria-disabled="true" role="link"
                            wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                            rel="prev">
                            Page précédente
                        </button>
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
                                <li><button class="flex items-center justify-center px-4 h-10 text-logo-orange-600 border border-gray-300 bg-logo-orange-50 hover:bg-logo-orange-100 hover:text-logo-orange-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white" aria-current="page" title="Page {{ $page }}" disabled>{{ $page }}</button></li>
                            @else
                                <li><button class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"  aria-current="page" title="Page {{ $page}}" wire:key="gotoPage-{{ $page }}" wire:click="setPage({{ $page }},'{{$paginator->getPageName() }}')">{{ $page  }}</button></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @if ($paginator->hasMorePages())
                    <li>
                        <button
                            class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                            wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                            rel="next">
                            Page suivante
                        </button>
                    </li>
                    <li>
                        <button
                            class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                            wire:click="setPage('{{ $paginator->lastPage() }}', '{{ $paginator->getPageName() }}')">
                            Dernière page
                        </button>
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
</div>
