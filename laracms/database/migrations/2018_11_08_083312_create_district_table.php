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

class CreateDistrictTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->increments('id');
            $table->string("citycode",30)->comment('城市编码');
            $table->string("adcode",30)->comment('区域编码');
            $table->string("name",30)->comment('行政区名称');
            $table->enum("level", ['country', 'province', 'city', 'district', 'street'])->comment('行政区划级别');
            $table->string("center",30)->comment('城市中心点');
            $table->integer("parent")->default(0)->comment('父级ID');
            $table->timestamps();
    
            $table->index('parent','parent_index');
            $table->index('adcode','adcode_index');
            $table->index('level','level_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('districts');
    }
}
