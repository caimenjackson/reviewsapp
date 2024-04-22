@if ($paginator->hasPages())
    <nav class="flex list-none space-x-1" aria-label="Pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="hidden" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white cursor-default leading-5" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white leading-5 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li aria-disabled="true">
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white cursor-default leading-5">{{ $element }}</span>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li aria-current="page">
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-yellow-500 leading-5 rounded-full">{{ $page }}</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white leading-5 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white leading-5 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li class="hidden" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white cursor-default leading-5" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </nav>
@endif
