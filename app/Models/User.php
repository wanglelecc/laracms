<?php

namespace App\Models;

use Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Traits\WithOrderHelper;
use App\Events\BehaviorLogEvent;


class User extends Authenticatable implements JWTSubject
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'phone', 'email', 'password', 'avatar', 'introduction', 'status', 'weixin_openid', 'weixin_unionid', 'weibo_id', 'qq_id', 'github_id', 'last_ip', 'last_location', 'last_time',
    ];

//    public $dispatchesEvents  = [
//        'saved' => BehaviorLogEvent::class,
//    ];
//
    public function titleName(){
        return 'name';
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    use HasRoles;
    use WithOrderHelper;
    use Notifiable{
        notify as protected laravelNotify;
    }

    public function notify($instance)
    {
        // 如果要通知的人是当前用户，就不必通知了！
        if ($this->id == Auth::id()) {
            return;
        }
        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }


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

        if ( ! starts_with($this->avatar, 'http')) {
            // 拼接完整的 URL
            $this->avatar = $this->avatar ? Storage::url($this->avatar) : config('app.url') . '/images/avatar.jpg';
        }

        return $this->avatar;
    }



}
