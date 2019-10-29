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

class CreateWechatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        # 公众号主表
        Schema::create('wechat', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('object_id')->comment('objectId');
            $table->enum("type",['subscribe','service'])->comment('公共号类型:subscribe订阅号;service服务号');
            $table->string('name',64)->comment('公众号名称');
            $table->char('account',30)->comment('原始ID');
            $table->char('app_id',30)->comment('appID');
            $table->char('app_secret',32)->comment('appSecret');
            $table->string('url',128)->nullable()->comment('url');
            $table->string('token',128)->nullable()->comment('Token');
            $table->string('qrcode',128)->nullable()->comment('二维码Code');
            $table->enum("primary", ['0','1'])->default('0')->comment('默认公众号:0未认证;1已认证');
            $table->enum("certified", ['0','1'])->default('0')->comment('认证类型:0未认证;1已认证');
            $table->enum("status",[0,1,2])->default('0')->comment('状态');
    
            $table->timestamps();
            $table->softDeletes();
    
            $table->unique('object_id','object_id_unique_index');
            $table->index('app_id','app_id_index');
        });

        # 公众号菜单表
        Schema::create('wechat_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group')->unsigned()->comment('公众号ID');
            $table->integer("parent")->default(0)->comment('父id');
            $table->string('name')->comment("菜单名称");
            $table->enum("type",['click','view','media_id','view_limited','text','event','content',])->comment('类型');
            $table->text("data")->nullable()->comment('附加内容');
            $table->integer("order")->default(0)->comment("排序");
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('group')->references('id')->on('wechat')->onDelete('cascade');
            $table->index('group','group_index');
            
        });

        # 公众号消息表
        Schema::create('wechat_message', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wechat_id')->unsigned()->comment('公众号ID');
            $table->smallInteger('public')->default(0)->comment('public');
            $table->char('wid',64)->comment('微信ID');
            $table->string('to',64)->comment('微信号');
            $table->string('from',64)->comment('发送方帐号');
            $table->mediumInteger('response')->unsigned()->comment('发送方帐号');
            $table->text('content')->comment('消息内容');
            $table->char('type',32)->comment("类型");
            $table->tinyInteger('replied')->default(0)->unsigned()->comment('回复ID');
            $table->dateTime('time')->comment('消息时间');
            
            $table->timestamps();
            $table->softDeletes();
    
            $table->index('wechat_id','wechat_id_index');
            $table->index('wid','wid_index');
            $table->index('to','to_index');
            $table->index('from','from_index');
            $table->index('response','response_index');
            $table->index('time','time_index');
            $table->index('replied','replied_index');
            
        });

        # 公众号响应表
        Schema::create('wechat_response', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wechat_id')->unsigned()->comment('公众号ID');
//            $table->smallInteger('public')->default(0)->comment('');
            $table->string('key',128)->comment('Key');
            $table->string('group',128)->comment('分组');
            $table->enum("type",['text','news','link',])->comment('类型');
            $table->string('source',128)->nullable()->comment('来源');
            $table->text('content')->comment('消息内容');
            
            $table->timestamps();
            $table->softDeletes();
    
            $table->index('wechat_id','wechat_id_index');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wechat_response');
        Schema::dropIfExists('wechat_message');
        Schema::dropIfExists('wechat_menu');
        Schema::dropIfExists('wechat');
    }
}
