@if ($paginator->hasPages())
    <div class="layui-box layui-laypage layui-laypage-default">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a href="javascript:;" class="layui-laypage-prev layui-disabled">&laquo;</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="layui-laypage-prev">&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="layui-laypage-spr">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>{{ $page }}</em></span>
                    @else
                        <a href="{{ $url }}" data-page="{{$page}}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="layui-laypage-next">&raquo;</a>
        @else
            <a href="javascript:;" class="layui-laypage-next layui-disabled">&raquo;</a>
        @endif
    </div>
@endif
