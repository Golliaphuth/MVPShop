@if ($paginator->hasPages())
    <div class="pagination-simple text-center">
        @if ($paginator->hasMorePages())
            <a class="load-more" href="{{ $paginator->nextPageUrl() }}" rel="next">{{ __('Load more') }}</a>
        @endif
    </div>
@endif
