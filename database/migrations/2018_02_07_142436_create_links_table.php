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

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration 
{
	public function up()
	{
		Schema::create('links', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name',128)->comment('友情链接名称');
            $table->string('description',255)->nullable()->comment('友情链接描述');
            $table->string('url',255)->comment('友情链接地址');
            $table->integer('rating')->default(0)->comment('友情链接评级');
            $table->string('image',255)->nullable()->comment('友情链接图标');
            $table->string('target',32)->comment('友情链接打开方式');
            $table->string('rel')->nullable()->comment('链接与网站的关系');
            $table->integer('order')->default(999)->comment('排序');
            $table->enum("status",[0,1])->default(1)->comment('状态:1显示;0不显示');
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('order','order_index');
            $table->index('status','status_index');
        });
	}

	public function down()
	{
		Schema::drop('links');
	}
}
