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

class CreateLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
//            $table->unsignedBigInteger('id');
            $table->enum("group",['laravel', 'jobs', 'queue', 'behavior', 'business', ])->comment('分组');
            $table->char('type',32)->comment('类型');
            $table->string('account',64)->comment('用户名');
            $table->string('browser',128)->comment('浏览器');
            $table->string('host',128)->comment('Host');
            $table->string('uri',128)->comment('Uri');
            $table->string('method',128)->comment('Method');
            $table->string('model', 128);
            $table->string('ip',32)->comment('IP');
            $table->string('location',128)->comment('地址');
            $table->text('user_agent')->comment('UserAgent');
            $table->text('description')->comment('操作内容');
            $table->text('data')->comment('数据');
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->index('group','group_index');
            $table->index('type','type_index');
            $table->index('account','account_index');
            $table->index('user_id','user_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
