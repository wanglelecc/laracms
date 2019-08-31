@php
    $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
    $category = get_value($content, 'category', 'desktop');
    $navigation_id = get_value($content, 'navigation_id', 0);

    $handler = app(\Wanglelecc\Laracms\Handlers\NavigationHandler::class);
    $navigations= $handler->select($handler->getNavigations($category));
@endphp
<!--
<div class="form-group has-feedback  has-icon-right">
    <label for="content[category]" class="col-md-2 col-sm-2 control-label required">导航类型</label>
    <div class="col-md-5 col-sm-10">
        <select name="content[category]" class="form-control">
            <option value="desktop" @if($category == 'desktop') selected @endif >主导航</option>
            <option value="footer" @if($category == 'footer') selected @endif>底部导航</option>
            <option value="mobile" @if($category == 'mobile') selected @endif>手机导航</option>
        </select>
    </div>
</div>
-->
<input type="hidden" name="content[category]" value="{{ $category }}" />
<div class="form-group has-feedback  has-icon-right">
    <label for="content[navigation_id]" class="col-md-2 col-sm-2 control-label required">导航栏目</label>
    <div class="col-md-5 col-sm-10">
        <select name="content[navigation_id]" class="form-control">
            <option value="0">/</option>
            @foreach($navigations as $key => $value)
                <option @if($navigation_id == $key) selected @endif value="{{$key}}">/ {{$value}}</option>
            @endforeach
        </select>
    </div>
</div>