
@if ($paginator->hasPages())
<ul class="pagination pagination-sm m-t-none m-b-none">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li><a class="disabled" aria-disabled="true" >
                    <span aria-hidden="true"><i class="fa fa-chevron-left"></i></span>
                </a></li>

            @else
                    <li><a href="{{ $paginator->previousPageUrl() }}"><span aria-hidden="true"><i class="fa fa-chevron-left"></i></span></a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><a class="disabled" aria-disabled="true"><span>{{ $element }}</span></a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><a class="active" aria-current="page"><span>{{ $page }}</span></a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())

                    <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><span aria-hidden="true"><i class="fa fa-chevron-right"></i></span></a></li>

            @else
                <li><a class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true"><i class="fa fa-chevron-right"></i></span>

                </a></li>
            @endif
        </ul>
@endif
