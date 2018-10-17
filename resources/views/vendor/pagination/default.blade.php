@if ($paginator->hasPages())
    <ul class="list-inline list-unstyled">
        @if ($paginator->onFirstPage())
            <li class="prev">
                <a href="javascript: void();" rel="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
            </li>
        @else
            <li class="prev">
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
            </li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><a href="#">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li class="next"><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-angle-right"></i> </a></li>
        @else
            <li class="next"><a href="javascript: void();" rel="next"><i class="fa fa-angle-right"></i> </a></li>
        @endif
    </ul>
@endif
