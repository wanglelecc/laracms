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

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('object_id')->comment('objectId');
            $table->string("alias",150)->nullable()->comment('别名');
            $table->string("title",150)->comment('文章标题');
            $table->string("subtitle",150)->nullable()->comment('副标题');
            $table->string("keywords",150)->nullable()->comment('关键字');
            $table->string("description")->nullable()->comment('文章描述');
            $table->string("author",60)->nullable()->comment('文章作者');
            $table->string("source",50)->nullable()->comment('文章来源');
//            $table->integer("category_id")->comment('分类id');
            $table->text("content")->comment('文章内容');
            $table->json("attribute")->nullable()->comment('附加属性');
            $table->string("thumb",255)->nullable()->comment('封面');
            $table->enum("is_link",[0,1])->default(0)->comment('isLink');
            $table->string("link",255)->nullable()->comment('Link');
            $table->string("type",30)->comment('类型');
            $table->unsignedInteger("reply_count")->default(0)->comment("回复量");
            $table->unsignedInteger("views")->default(0)->comment("浏览数");
            $table->integer("order")->default(0)->comment("排序");
            $table->integer("weight")->default(0)->comment("权重");
            $table->string("template")->nullable()->comment('模板');
            $table->text("css")->nullable()->comment('style');
            $table->text("js")->nullable()->comment('javascript');
            $table->enum("top",[0,1])->default(0)->comment('置顶');
            $table->enum("status",[0,1,2])->default(1)->comment('状态');
            $table->integer("created_op")->default(0)->comment("创建人");
            $table->integer("updated_op")->default(0)->comment("更新人");
            $table->timestamps();
    
            $table->softDeletes();
            
            $table->unique('object_id','object_id_unique');
            $table->index('order','order_index');
            $table->index('views','views_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
