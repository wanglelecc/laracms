<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Setting;

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
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'contacts', 'value' => '望乐乐']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'phone', 'value' => '13366995858']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'fax', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'email', 'value' => 'wanglelecc@gmail.com']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'qq', 'value' => '294990941']);
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
