@if ($paginator->hasPages())
    <ul class="pagination d-block">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <li><a class="btn btn-primary float-left" href="{{ $paginator->previousPageUrl() }}" rel="prev"><<</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a class="btn btn-primary float-right" href="{{ $paginator->nextPageUrl() }}" rel="next">>></a></li>
        @endif
    </ul>
@endif
