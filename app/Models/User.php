<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Traits\WithOrderHelper;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use HasRoles;
    use WithOrderHelper;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'phone', 'email', 'password', 'avatar', 'introduction', 'status', 'weixin_openid', 'weixin_unionid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($value)
    {
        // 如果值的长度等于 60，即认为是已经做过加密的情况
        if (strlen($value) != 60) {

            // 不等于 60，做密码加密处理
            $value = bcrypt($value);
        }

        $this->attributes['password'] = $value;
    }

    public function setAvatarAttribute($path)
    {
        // 如果不是 `http` 子串开头，那就是从后台上传的，需要补全 URL
//        if ( ! starts_with($path, 'http')) {
//
//            // 拼接完整的 URL
//            $path = config('app.url') . "/uploads/images/avatars/$path";
//        }

        $this->attributes['avatar'] = $path;
    }

    public function getAvatar(){
        return $this->avatar ? Storage::url($this->avatar) : config('app.url') . '/images/avatar.jpg';
    }


}
