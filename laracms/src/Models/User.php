<?php
/**
 * LaraCMS - CMS based on laravel
 *
 * @category  LaraCMS
 * @package   Laravel
 * @author    Wanglelecc <wanglelecc@gmail.com>
 * @date      2018/06/06 09:08:00
 * @copyright Copyright 2018 LaraCMS
 * @license   https://opensource.org/licenses/MIT
 * @github    https://github.com/wanglelecc/laracms
 * @link      https://www.laracms.cn
 * @version   Release 1.0
 */

namespace Wanglelecc\Laracms\Models;

use Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Wanglelecc\Laracms\Models\Traits\WithOrderHelper;
use Wanglelecc\Laracms\Events\BehaviorLogEvent;

/**
 * 用户模型
 *
 * Class User
 * @package App\Models
 */
class User extends Authenticatable implements JWTSubject
{
 
//    use SoftDeletes;
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'phone', 'email', 'password', 'avatar', 'introduction', 'status', 'weixin_openid', 'weixin_unionid', 'weibo_id', 'qq_id', 'github_id', 'last_ip', 'last_location', 'last_at',
    ];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'last_at'];

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

    /**
     * 处理用户头像地址
     *
     * @param $path
     */
    public function setAvatarAttribute($path)
    {
        $this->attributes['avatar'] = $path;
    }

    /**
     * 返回完整的头像地址
     *
     * @return mixed|string
     */
    public function getAvatar(){

        if ( ! starts_with($this->avatar, 'http')) {
            // 拼接完整的 URL
            $this->avatar = storage_image_url($this->avatar);
        }

        return $this->avatar;
    }



}
