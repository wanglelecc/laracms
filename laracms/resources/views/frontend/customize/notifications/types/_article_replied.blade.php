<li data-id="{{$notification->id}}">
    <blockquote class="layui-elem-quote">
        <a href="" target="_blank"><cite>{{ $notification->data['user_name'] }}</cite></a>回复了您<a target="_blank" href="{{ $notification->data['article_link'] }}"><cite>{{ $notification->data['article_title'] }}</cite></a>
        <p>{!! $notification->data['reply_content'] !!}</p>
    </blockquote>
    <p><span title="{{ $notification->created_at }}">{{ $notification->created_at->diffForHumans() }}</span>
        {{--<a href="javascript:;" class="layui-btn layui-btn-small layui-btn-danger fly-delete">删除</a>--}}
        <br />
    </p>
</li>