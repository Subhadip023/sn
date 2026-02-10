@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex gap-2 justify-center items-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded cursor-not-allowed flex items-center gap-1">
                <i class="fas fa-chevron-left"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition-colors flex items-center gap-1">
                <i class="fas fa-chevron-left"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded cursor-default">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-4 py-2 bg-primary-red text-white rounded cursor-default font-medium">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition-colors">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition-colors flex items-center gap-1">
                Next <i class="fas fa-chevron-right"></i>
            </a>
        @else
            <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded cursor-not-allowed flex items-center gap-1">
                Next <i class="fas fa-chevron-right"></i>
            </span>
        @endif
    </nav>
@endif
