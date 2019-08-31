<header class="main-header">
    <nav class="navbar navbar-fixed-top bg-primary">
        <div class="navbar-header">
            <a class="navbar-toggle" href="javascript:;" data-toggle="collapse" data-target=".navbar-collapse"><i class="icon icon-th-large"></i></a>
            <a class="sidebar-toggle" href="javascript:;" data-toggle="push-menu"><i class="icon icon-bars"></i></a>
            <a class="navbar-brand" href="#">
                <span class="logo">{{ config('app.name', 'LaraCMS')  }}</span>
                <span class="logo-mini">LC</span>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="javascript:;" data-toggle="push-menu"><i class="icon icon-bars"></i></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @guest
                        <li><a href="{{ route('administrator.login') }}">登录</a></li>
                    @else
                    <li class="dropdown">
                        <a href="javascript:;" data-toggle="dropdown">
                            <img src="{{ Auth::user()->getAvatar() }}"  width="32px" height="32px" class="img-circle" alt="{{ Auth::user()->name }}" />&nbsp;&nbsp;
                            {{ Auth::user()->name }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('user.edit', Auth::user()->id)  }}"><i class="icon icon-edit"></i> 基本资料</a></li>
                            <li><a href="{{ route('administrator.password.edit', Auth::user()->id )  }}"><i class="icon icon-key"></i> 修改密码</a></li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('administrator.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="icon icon-signout"></i> 退出</a>
                                <form id="logout-form" action="{{ route('administrator.logout') }}" method="GET" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
