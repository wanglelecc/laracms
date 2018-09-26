<div class="form-group  has-icon-right">
    <label for="captcha" class="col-md-2 col-sm-2 control-label  required ">验证码</label>
    <div class="col-md-3 col-sm-10">
        <input type="text" class="form-control " id="captcha" name="captcha" autocomplete="off" placeholder="" value="{{ old('captcha') }}"
               required
               data-fv-trigger="blur"
               minlength="4"
               maxlength="6"
        >
    </div>
    <div class="col-md-2">
        <img class="img-rounded captcha" src="{{ captcha_src('form') }}" onclick="this.src='{{ captcha_src("form") }}?'+Math.random()" title="点击图片重新获取验证码">
    </div>
</div>