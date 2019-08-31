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

class CreateNavigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigations', function (Blueprint $table) {
            $table->increments('id');
            $table->enum("category",['desktop','footer','mobile',])->comment('导航分类');
            $table->enum("type",['action','link','article','page','category', 'navigation'])->comment('类型');
            $table->string("title",100)->comment('标题');
            $table->string("description",255)->nullable()->comment('描述');
            $table->enum("target",['_self','_blank'])->default('_self')->comment("是否新建标签");
            $table->string("link",255)->nullable()->comment('URL');
            $table->string("image",255)->nullable()->comment('图片');
            $table->string("icon",255)->nullable()->comment('图标');
            $table->integer("parent")->comment('父id');
            $table->string("path")->comment('路径');
            $table->json("params")->comment('参数');
            $table->enum("is_show",['0','1'])->default('1')->comment("是否显示");
            $table->integer("order")->comment('排序');
            $table->timestamps();
            
            $table->softDeletes();
    
            $table->index('category','category_index');
            $table->index('type','type_index');
            $table->index('order','order_index');
            $table->index('is_show','is_show_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('navigations');
    }
}
