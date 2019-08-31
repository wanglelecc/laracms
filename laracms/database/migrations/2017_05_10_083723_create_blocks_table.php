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

class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 最新文章：latestArticle
         * 热门文章：hotArticle
         * 最新产品：latestProduct
         * 热门产品：hotProduct
         * 幻灯片：slide
         * 文章分类：articleTree
         * 产品分类：productTree
         * 博客分类：blogTree
         * 栏目导航：navigation
         * 单页列表：pageList
         * 联系我们：contact
         * 公司简介：about
         * 友情链接：links
         * 网站头部：header
         * 关注我们：followUs
         * 自定义：html
         * HTML源代码：htmlcode
         * PHP源代码：phpcode
         * 推荐位：recommend
         */
        Schema::create('blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('object_id', 64)->comment('objectId');
            $table->integer("group")->default(0)->comment('分组');
            $table->enum("type",['latestArticle','hotArticle','latestProduct','hotProduct','slide','articleTree','productTree', 'navigation', 'blogTree','pageList','contact','about','links','header','followUs','html','htmlcode','phpcode', 'recommend', ])->comment('类型');
            $table->string("template")->default('default')->comment('模板');
            $table->string('title')->comment("标题");
            $table->string('icon')->nullable()->comment('图标');
            $table->string('more_title')->nullable()->comment("更多链接名称");
            $table->string("more_link")->nullable()->comment('更多链接');
            $table->text("content")->nullable()->comment('内容');
            $table->integer("created_op")->default(0)->comment("创建人");
            $table->integer("updated_op")->default(0)->comment("更新人");
            $table->timestamps();
            $table->unique('object_id','object_id_unique');
            $table->index('type','type_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('blocks');
    }
}
