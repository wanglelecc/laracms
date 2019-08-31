@extends('backend::layouts.app')

@section('title', $title = $role->id ? '编辑角色' : '添加角色' )

@section('breadcrumb')
    <li><a href="javascript:;">系统设置</a></li>
    <li><a href="javascript:;">角色管理</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')
    @php
        $zNodes = [];
        $permissionValues = [];
        foreach($permissions as $key => $val){
            $checked = in_array($val->name,$rolePermissions) || in_array($val, old('permission',[]));
            $zNodes[] = [
                'id' => $val->id,
                'pId' => $val->parent,
                'name' => $val->remarks,
                'open' => true,
                'value' => $val->name,
                'checked' => $checked,
            ];

            if($checked === true){ $permissionValues[] = $val->name; }
        }
    @endphp
    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">

                    <form id="form-validator" class="form-horizontal" method="POST" action="{{ $role->id ? route('roles.update', $role->id) : route('roles.store') }}?redirect={{ previous_url() }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="{{ $role->id ? 'PATCH' : 'POST' }}">

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="name" class="col-md-2 col-sm-2 control-label required">角色名称</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="" value="{{ old('name',$role->name) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="64"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="remarks" class="col-md-2 col-sm-2 control-label required">角色备注</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="remarks" name="remarks" autocomplete="off" placeholder="" value="{{ old('remarks',$role->remarks) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="64"
                            ></div>
                        </div>

                        <div class="form-group has-feedback has-icon-right">
                            <label for="" class="col-md-2 col-sm-2 control-label required">所属权限</label>
                            <div class="col-md-5 col-sm-10">
                                <div class="panel">
                                    <ul id="permissionTree" class="ztree"></ul>
                                    <input type="hidden" id="form-permission" name="permission" value="{{  implode(',', $permissionValues) }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-5 col-sm-10">
                                <button type="submit" class="btn btn-primary">提交</button>
                                <button type="reset" class="btn btn-default">重置</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('vendor/laracms/plugins/ztree/css/zTreeStyle/zTreeStyle.css')}}">
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('vendor/laracms/plugins/ztree/js/jquery.ztree.core.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/laracms/plugins/ztree/js/jquery.ztree.excheck.js')}}"></script>
    <script type="text/javascript">
        var setting = {
            check: {
                enable: true
            },
            data: {
                simpleData: {
                    enable: true
                }
            },
            callback:{
                beforeCheck:true,
                onCheck:onCheck
            }
        };

        var zNodes = @php echo json_encode($zNodes, JSON_UNESCAPED_SLASHES) @endphp;

        $.fn.zTree.init($("#permissionTree"), setting, zNodes);
        var zTree = $.fn.zTree.getZTreeObj("permissionTree");
        zTree.setting.check.chkboxType = { "Y":"ps", "N" : "ps"};

        function onCheck(e,treeId,treeNode) {

            var treeObj = $.fn.zTree.getZTreeObj("permissionTree"),
                nodes = treeObj.getCheckedNodes(true),
                permissionValues = [];
            for (var i = 0; i < nodes.length; i++) {
                permissionValues.push(nodes[i].value);
            }

            $("#form-permission").val(permissionValues.join(','));
        }
    </script>
@endsection