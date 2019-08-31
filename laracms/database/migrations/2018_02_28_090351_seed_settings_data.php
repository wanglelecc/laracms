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

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Wanglelecc\Laracms\Models\Setting;

class SeedSettingsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 站点信息
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'status', 'value' => '0']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'close_tips', 'value' => '非常抱歉，站点正在维护，稍后恢复...']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'name', 'value' => config('app.name')]);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'copyright', 'value' => 'LaraCMS']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'create_year', 'value' => date('Y')]);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'keywords', 'value' => 'LaraCMS']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'index_keywords', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'slogan', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'icp', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'icp_link', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'meta', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'description', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'statistics', 'value' => '']);

        // 公司信息
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'company', 'key' => 'name', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'company', 'key' => 'description', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'company', 'key' => 'content', 'value' => '']);

        // 联系方式
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'contacts', 'value' => 'Wanglelecc']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'phone', 'value' => '13300000000']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'fax', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'email', 'value' => 'wanglelecc@gmail.com']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'qq', 'value' => '0000000']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'weixin', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'weibo', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'wangwang', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'site', 'value' => 'https://www.wanglele.cc/']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'address', 'value' => 'Beijing']);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Setting::where('id', '>', 0)->delete();
    }
}
