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
                    <li class="layui-this" lay-id="info">我的资料</li>
                    <li lay-id="avatar">头像</li>
                    <li lay-id="pass">密码</li>
                    <li lay-id="bind">帐号绑定</li>
                </ul>
                <div class="layui-tab-content" style="padding: 20px 0;">
                    <div class="layui-form layui-form-pane layui-tab-item layui-show">
                        <form method="post" action="{{route('user.update_info')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" class="mini-hidden" value="PATCH">

                            @if(!$user->phone)
                            <div class="layui-form-item">
                                <label for="L_email" class="layui-form-label">手机</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="L_phone" name="phone" required="" lay-verify="phone" autocomplete="off" value="{{ old('phone', $user->phone) }}" placeholder="请输入手机号" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">您需要完成手机验证</div>
                            </div>
                            <div class="layui-form-item">
                                <label for="L_vercode" class="layui-form-label">验证码</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="L_vercode" name="verification_code" required="" lay-verify="required" placeholder="请输入手机验证码" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-form-mid" style="padding: 0!important;">
                                    <button type="button" class="layui-btn layui-btn-normal" id="FLY-getvercode">获取验证码</button>
                                </div>
                            </div>
                            @else
                            <div class="layui-form-item">
                                <label for="L_email" class="layui-form-label">手机</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="L_phone" name="" disabled="disabled" required="" lay-verify="phone" autocomplete="off" value="{{ old('phone',$user->phone) }}" placeholder="请输入手机号" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux"><span style="color: #5FB878">您已完成手机号绑定。</span> 手机号暂不支持修改。</div>
                            </div>
                            @endif

                            <div class="layui-form-item">
                                <label for="L_email" class="layui-form-label">邮箱</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="L_email" name="email" _disabled="disabled" required lay-verify="email" autocomplete="off" value="{{ old('email',$user->email) }}" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">
                                    @if($user->email_is_activated == 0)
                                    如果您在邮箱已激活的情况下，变更了邮箱，需<a href="{{route('user.activate')}}" style="font-size: 12px; color: #4f99cf;">重新验证邮箱</a>。
                                    @endif
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label for="L_username" class="layui-form-label">昵称</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="L_username" name="name" _disabled="disabled" required lay-verify="required" autocomplete="off" value="{{ old('name',$user->name) }}" class="layui-input">
                                </div>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <input type="radio" name="sex" value="0" @if(old('sex', $user->sex) == '0') checked @endif title="男">
                                        <input type="radio" name="sex" value="1" @if(old('sex', $user->sex) == '1') checked @endif title="女">
                                    </div>
                                </div>
                            </div>

                            <div class="layui-form-item layui-form-text">
                                <label for="L_sign" class="layui-form-label">个人简介</label>
                                <div class="layui-input-block">
                                    <textarea placeholder="随便写些什么刷下存在感" id="L_sign"  name="introduction" autocomplete="off" class="layui-textarea" style="height: 80px;">{{ old('introduction',$user->introduction) }}</textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <button class="layui-btn" key="set-mine" type="submit" -lay-filter="*" -lay-submit>确认修改</button>
                            </div>
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
                            <li class="fly-msg @if($user->github_id) app-havebind @endif">
                                <i class="iconfont icon-github"></i>
                                @if($user->github_id)
                                    <span>已成功绑定，您可以使用Github直接登录，当然，您也可以</span>
                                    <a href="{{route('oauth.login.unbind', 'github')}}" class="acc-unbind" type="github_id">解除绑定</a>
                                @else
                                    <a href="{{route('oauth.login','github')}}" class="acc-github" type="github_id"  onclick="layer.msg('正在绑定Github', {icon:16, shade: 0.1, time:0})" >立即绑定</a>
                                    <span>，即可使用Github帐号登录</span>
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
                        $("#input-avatar").val(res.path);
                        $("#image-avatar").attr("src",res.url);
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

