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

class CreateCategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment("分类名称");
            $table->string("keywords",150)->nullable()->comment('关键字');
            $table->string("description")->nullable()->comment('描述');
            $table->integer("parent")->comment('父id');
            $table->integer("order")->comment('排序');
            $table->string("path")->comment('路径');
            $table->string("type",30)->comment('类型');
            $table->string("link")->nullable()->comment('链接');
            $table->string("template")->nullable()->comment('模板');
            $table->timestamps();
            $table->softDeletes();
            $table->index('type','type_index');
            $table->index('parent','parent_index');
            $table->index('path','path_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categorys');
    }

}
