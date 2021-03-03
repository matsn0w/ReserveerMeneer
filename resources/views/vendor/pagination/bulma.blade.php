@if ($paginator->hasPages())
    <nav class="pagination is-centered">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="pagination-previous" aria-disabled="true" aria-label="@lang('pagination.previous')" disabled>
                <span aria-hidden="true">Previous</span>
            </a>
        @else
            <a class="pagination-previous" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Previous</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="pagination-next" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next</a>
        @else
            <a class="pagination-next" aria-disabled="true" aria-label="@lang('pagination.next')" disabled>
                <span aria-hidden="true">Next</span>
            </a>
        @endif

        <ul class="pagination-list">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li aria-disabled="true"><span class="pagination-ellipsis">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination-link is-current" aria-label="{{ $page }}" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a class="pagination-link" aria-label="Go to page {{ $page }}" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
    </nav>

    <p class="has-text-centered">Resultaat {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} van {{ $paginator->total() }}</p>
@endif
