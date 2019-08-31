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

namespace Wanglelecc\Laracms\Http\Controllers\Administrator;

use Wanglelecc\Laracms\Http\Controllers\Controller as BaseController;

/**
 * Administrator 基础控制器
 *
 * Class Controller
 * @package Wanglelecc\Laracms\Http\Controllers
 */
class Controller extends BaseController
{
    // 后台导航ID
    public static $activeNavId = 'dashboard';
}
