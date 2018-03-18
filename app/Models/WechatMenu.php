<?php

namespace App\Models;

class WechatMenu extends Model
{
    public $table = 'wechat_menu';
    protected $fillable = ['group', 'parent', 'name', 'type', 'data', 'order'];
}
