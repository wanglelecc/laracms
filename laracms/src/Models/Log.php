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

/**
 * 日志模型
 * 
 * Class Log
 * @package Wanglelecc\Laracms\Models
 */
class Log extends Model
{
    protected $fillable = ['group','type', 'account', 'browser', 'host', 'uri', 'method', 'model', 'ip', 'location', 'user_agent', 'description', 'data', 'user_id',];
}
