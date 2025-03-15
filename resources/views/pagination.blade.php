<style>
    /* Pagination */
    .content nav::before{
        display: none;
    }
.page-section {
    margin-top: 20px;
    text-align: center;
}

.pagination {
    display: inline-block;
    padding-left: 0;
    margin: 0;
    justify-content: center;
    border-radius: 0.25rem;
}

.page-item {
    display: inline;
}

.page-item:not(:last-child) {
    margin-right: 5px;
}

.page-link {
    position: relative;
    display: block;
    padding: 0.5rem 0.75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: hsl(142, 76%, 36%);
}

.page-link:hover {
    z-index: 2;
    color: hsl(142, 86%, 26%);
    text-decoration: none;
    background-color: #e9ecef;
    border-color: #dee2e6;
}

.page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: hsl(142, 76%, 36%);
    border-radius: 7px;
    border-color: hsl(142, 76%, 36%);
}

.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    cursor: auto;
    background-color: #fff;
    border-color: #dee2e6;
}

/* Icons */
.page-link i {
    vertical-align: middle;
}
</style>

@if($paginator->hasPages())
    <nav class="page-section">
        <ul class="pagination" style="display: flex">
            @if($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="javascript:void(0)" aria-label="Previous" style="color:#6c757d;">
                        <span aria-hidden="true">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}&category={{ request('category') }}&date={{ request('date') }}" aria-label="Previous">
                        <span aria-hidden="true">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if(is_string($element))
                    <li class="page-item disabled">
                        <a class="page-link" href="javascript:void(0)">{{ $element }}</a>
                    </li>
                @endif

                @if(is_array($element))
                    @foreach ($element as $page => $url)
                        @if($page == $paginator->currentPage())
                            <li class="page-item active">
                                <a class="page-link" href="javascript:void(0)">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}&category={{ request('category') }}&date={{ request('date') }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}&category={{ request('category') }}&date={{ request('date') }}" aria-label="Next">
                        <span aria-hidden="true">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="javascript:void(0)" aria-label="Next" style="color:#6c757d;">
                        <span aria-hidden="true">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
