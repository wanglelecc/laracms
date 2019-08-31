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
 * 中国行政区
 *
 * Class Block
 * @package Wanglelecc\Laracms\Models
 */
class District extends Model
{
    protected $fillable = ['id','citycode', 'adcode', 'name', 'level', 'center', 'parent'];
}
