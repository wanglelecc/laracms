<?php

namespace App\Models;

class Wechat extends Model
{
    public $table = 'wechat';
    protected $fillable = ['type', 'object_id', 'name', 'account', 'app_id', 'app_secret', 'url', 'token', 'qrcode', 'primary', 'certified'];
}
