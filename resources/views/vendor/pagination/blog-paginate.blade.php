@if ($paginator->hasPages())
    <div class="pagination_wrap">
        <ul class="pagination_nav unordered_list">

            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a><i class="fas fa-long-arrow-left"></i></a>
                </li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i
                            class="fas fa-long-arrow-left"></i></a></li>
            @endif


            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="active" aria-disabled="true">{{ $element }}</li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><a>{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach



            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i
                            class="fas fa-long-arrow-right"></i></a></li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')"><i
                        class="fas fa-long-arrow-right"></i></li>
            @endif


        </ul>
    </div>
@endif
