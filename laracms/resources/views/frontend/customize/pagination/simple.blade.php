@if ($paginator->hasPages())
    <div class="layui-box layui-laypage layui-laypage-default">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a href="javascript:;" class="layui-laypage-prev layui-disabled" data-page="0">@lang('pagination.previous')</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="layui-laypage-prev" data-page="0">@lang('pagination.previous')</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="layui-laypage-prev" data-page="0">@lang('pagination.next')</a>
        @else
            <a href="{{ $paginator->nextPageUrl() }}" class="layui-laypage-prev layui-disabled" data-page="0">@lang('pagination.next')</a>
        @endif
    </div>
@endif
