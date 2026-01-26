@if ($paginator->hasPages())
    <div class="flex gap-2 justify-center items-center mb-8" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded cursor-not-allowed flex items-center gap-1">
                <i class="fas fa-chevron-left"></i> Prev
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition-colors flex items-center gap-1">
                <i class="fas fa-chevron-left"></i> Prev
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-4 py-2 text-gray-800">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-4 py-2 bg-primary-red text-white rounded hover:bg-[#c41230] transition-colors">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition-colors">{{ $page }}</a>
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
    </div>
@endif
