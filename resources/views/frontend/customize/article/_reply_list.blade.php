<ul class="jieda" id="jieda">

    @foreach ($replies as $index => $reply)
    <li data-id="{{ $reply->id }}" class="jieda-daan">
        <a name="item-{{ $reply->id }}"></a>
        <div class="detail-about detail-about-reply">
            <a class="fly-avatar" href="">
                <img src="{{ $reply->user->getAvatar() }}" alt="{{ $reply->user->name }}">
            </a>
            <div class="fly-detail-user">
                <a href="" class="fly-link">
                    <cite>{{ $reply->user->name }}</cite>
                </a>

                <span>#{{ $index+1 }}</span>
                <!--
                <span style="color:#5FB878">(管理员)</span>
                <span style="color:#FF9E3F">（社区之光）</span>
                <span style="color:#999">（该号已被封）</span>
                -->
            </div>

            <div class="detail-hits">
                <span title="{{ $reply->created_at }}">{{ $reply->created_at->diffForHumans() }}</span>
            </div>

            {{--<i class="iconfont icon-caina" title="最佳答案"></i>--}}
        </div>
        <div class="detail-body jieda-body photos">
            {!! $reply->content !!}
        </div>
        <div class="jieda-reply">
            @can('destroy', $reply)
            {{--<span class="jieda-zan zanok" type="zan">--}}
               {{--<i class="iconfont icon-zan"></i>--}}
               {{--<em>99</em>--}}
            {{--</span>--}}

            <span type="reply">
                <i class="iconfont icon-svgmoban53"></i>回复
              </span>


            <div class="jieda-admin">
                {{--<span type="edit">编辑</span>--}}
                    <button data-url="{{ route('replies.destroy', $reply->id) }}" class="layui-btn layui-btn-danger layui-btn-xs form-reply-delete" type="submit">删除</button>
                <!-- <span class="jieda-accept" type="accept">采纳</span> -->
            </div>
            @endcan
        </div>
    </li>
    @endforeach

    <!-- 无数据时 -->
    @empty($replies->count())
    <li class="fly-none">消灭零回复</li>
    @endempty
</ul>