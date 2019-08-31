@extends('frontend::layouts.app')

@section('title', $title = '基本设置')

@php
    $breadcrumb = false;
@endphp

@section('breadcrumb')
    <a><cite>{{$title}}</cite></a>
@endsection

@section('content')
    <div class="layui-container fly-marginTop fly-user-main">

        @include('frontend::user._side', ['side'=>'settings'])

        <div class="fly-panel fly-panel-user" pad20>
            <div class="layui-tab layui-tab-brief" lay-filter="user">
                <ul class="layui-tab-title" id="LAY_mine">
                    <li class="layui-this" lay-id="activate">激活邮箱</li>
                </ul>
                <div class="layui-tab-content" style="padding: 20px 0;">
                    <div class="layui-form layui-form-pane layui-tab-item layui-show">
                        <form method="post" action="{{route('user.activate')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" class="mini-hidden" value="PATCH">

                            <ul class="layui-form">
                                <li class="layui-form-li">
                                    <label for="activate">您的邮箱：</label>
                                    <span class="layui-form-text">{{$user->email}}
                                        @if($user->email_is_activated == '0')
                                        <em style="color:#c00;">（尚未激活）</em>
                                        @else
                                        <em style="color: #5FB878;">（已激活）</em>
                                        @endif
                                    </span>
                                </li>
                                <li class="layui-form-li" style="margin-top: 20px; line-height: 26px;">
                                    <div> 1. 如果您未收到邮件，或激活链接失效，您可以 <a class="layui-form-a" style="color:#4f99cf;" id="" href="{{route('user.activate')}}" email="wanglelecc@gmail.com">重新发送邮件</a>，或者 <a class="layui-form-a" style="color:#4f99cf;" href="{{route('user.settings','#info')}}">更换邮箱</a>； </div>
                                    <div> 2. 如果您始终没有收到发送的激活邮件，请注意查看您邮箱中的垃圾邮件； </div>
                                    <div> 3. 如果你实在无法激活邮件，您还可以邮箱联系管理员； </div>
                                </li>
                            </ul>

                        </form>
                    </div>

                    <div class="layui-form layui-form-pane layui-tab-item">
                        <form id="form-avatar" method="post" action="{{route('user.update_avatar')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" class="mini-hidden" value="PATCH">
                            <input type="hidden" name="avatar" id="input-avatar" value="{{ old('avatar',$user->avatar) }}" />

                        <div class="layui-form-item">
                            <div class="avatar-add">
                                <p>建议尺寸168*168，支持jpg、png、gif，最大不能超过50KB</p>
                                <button type="button" class="layui-btn upload-img" id="avatar">
                                    <i class="layui-icon">&#xe67c;</i>上传头像
                                </button>
                                <img id="image-avatar" src="{{ $user->getAvatar() }}">
                                <span class="loading"></span>
                            </div>
                        </div>
                        </form>
                    </div>

                    <div class="layui-form layui-form-pane layui-tab-item">
                        <form  action="{{route('user.update_password')}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" class="mini-hidden" value="PATCH">

                            <div class="layui-form-item">
                                <label for="L_nowpass" class="layui-form-label">当前密码</label>
                                <div class="layui-input-inline">
                                    <input type="password" id="L_nowpass" name="old_password" required lay-verify="required" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label for="L_pass" class="layui-form-label">新密码</label>
                                <div class="layui-input-inline">
                                    <input type="password" id="L_pass" name="password" required lay-verify="required" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">6到16个字符</div>
                            </div>
                            <div class="layui-form-item">
                                <label for="L_repass" class="layui-form-label">确认密码</label>
                                <div class="layui-input-inline">
                                    <input type="password" id="L_repass" name="password_confirmation" required lay-verify="required" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <button class="layui-btn" key="set-mine" type="submit" lay-filter="*" -lay-submit>确认修改</button>
                            </div>
                        </form>
                    </div>

                    <div class="layui-form layui-form-pane layui-tab-item">
                        <ul class="app-bind">
                            <li class="fly-msg @if($user->qq_id) app-havebind @endif">
                                <i class="iconfont icon-qq"></i>
                                @if($user->qq_id)
                                <span>已成功绑定，您可以使用QQ帐号直接登录，当然，您也可以</span>
                                <a href="{{route('oauth.login.unbind', 'qq')}}" class="acc-unbind" type="qq_id">解除绑定</a>
                                @else
                                <a href="{{route('oauth.login','qq')}}" onclick="layer.msg('正在绑定微博QQ', {icon:16, shade: 0.1, time:0})" class="acc-bind" type="qq_id">立即绑定</a>
                                <span>，即可使用QQ帐号登录</span>
                                @endif
                            </li>
                            <li class="fly-msg @if($user->weibo_id) app-havebind @endif">
                                <i class="iconfont icon-weibo"></i>
                                @if($user->weibo_id)
                                <span>已成功绑定，您可以使用微博直接登录，当然，您也可以</span>
                                <a href="{{route('oauth.login.unbind', 'weibo')}}" class="acc-unbind" type="weibo_id">解除绑定</a>
                                @else
                                <a href="{{route('oauth.login','weibo')}}" class="acc-weibo" type="weibo_id"  onclick="layer.msg('正在绑定微博', {icon:16, shade: 0.1, time:0})" >立即绑定</a>
                                <span>，即可使用微博帐号登录</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        layui.use('upload', function(){
            var upload = layui.upload;
            var avatarAdd = $('.avatar-add');

            //执行实例
            var uploadInst = upload.render({
                elem: '#avatar' // 绑定元素
                ,url: '{{ route('uploader') }}?file_type=image&folder=avatar&object_id={{$user->id}}' // 上传接口
                ,field: 'upload_file'
                ,before: function(){
                    avatarAdd.find('.loading').show();
                }
                ,done: function(res){
                    if(res.success == true){
                        $("#input-avatar").val(res.file_uri);
                        $("#image-avatar").attr("src",res.file_path);
                        $("#form-avatar").submit();
                    } else {
                        layer.msg(res.msg, {icon: 5});
                    }
                    avatarAdd.find('.loading').hide();
                }
                ,error: function(){
                    //请求异常回调
                    avatarAdd.find('.loading').hide();
                    layer.alert('上传失败，请重试!', 2);

                }
            });
        });
    </script>
@endsection

