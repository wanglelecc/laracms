@extends('backend::layouts.app')

@section('title',$title = '控制台')

@section('breadcrumb')
    <li class="active">仪表盘</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-info">
                <div class="info-box-icon">
                    <i class="icon icon-file-text"></i>
                </div>
                <div class="info-box-content">
                    <span class="info-box-text">新增订单</span>
                    <span class="info-box-number">320
                        {{--<small>单</small>--}}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-primary">
                <div class="info-box-icon">
                    <i class="icon icon-user"></i>
                </div>
                <div class="info-box-content">
                    <span class="info-box-text">新增用户</span>
                    <span class="info-box-number">90
                        {{--<small>个</small>--}}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-warning">
                <div class="info-box-icon">
                    <i class="icon icon-bars"></i>
                </div>
                <div class="info-box-content">
                    <span class="info-box-text">在售商品</span>
                    <span class="info-box-number">129
                        {{--<small>种</small>--}}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-danger">
                <div class="info-box-icon">
                    <i class="icon icon-eye-open"></i>
                </div>
                <div class="info-box-content">
                    <span class="info-box-text">库存预警</span>
                    <span class="info-box-number">66
                        {{--<small>元</small>--}}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title">产品信息</div>
                </div>
                <div class="panel-body">
                    <table class="table table-info">
                        <tr>
                            <td width="100">产品名称</td>
                            <td><a target="_blank" href="https://www.laracms.cn">LaraCMS</a></td>
                        </tr>
                        <tr>
                            <td>核心框架</td>
                            <td>Laravel / {{ app()->version() }}</td>
                        </tr>
                        <tr>
                            <td>开发作者</td>
                            <td><a target="_blank" href="https://github.com/wanglelecc">Wanglelecc（稀饭不加糖）</a></td>
                        </tr>

                        <tr>
                            <td>系统时区</td>
                            <td>{{ config('app.timezone') }}</td>
                        </tr>
                        <tr>
                            <td>语言环境</td>
                            <td>{{ config('app.locale') }}</td>
                        </tr>
                        <tr>
                            <td>系统模式</td>
                            <td>{{ config('app.env') }}</td>
                        </tr>
                        <tr>
                            <td>系统URL</td>
                            <td>{{ config('app.url') }}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title">服务器信息</div>
                </div>
                <div class="panel-body">
                    <table class="table table-info">
                        <tr>
                            <td width="100">操作系统</td>
                            <td>{{ php_uname() }}</td>
                        </tr>
                        <tr>
                            <td>运行环境</td>
                            <td>{{ array_get($_SERVER, 'SERVER_SOFTWARE') }}</td>
                        </tr>
                        <tr>
                            <td>PHP版本</td>
                            <td>PHP / {{PHP_VERSION}}</td>
                        </tr>
                        <tr>
                            <td>缓存驱动</td>
                            <td>{{ config('cache.default') }}</td>
                        </tr>
                        <tr>
                            <td>会话驱动</td>
                            <td>{{ config('session.driver') }}</td>
                        </tr>
                        <tr>
                            <td>队列驱动</td>
                            <td>{{ config('queue.default') }}</td>
                        </tr>
                        <tr>
                            <td>文件系统</td>
                            <td>{{ config('filesystems.default') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
