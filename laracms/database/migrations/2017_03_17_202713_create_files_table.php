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

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->enum("type",['image','voice','video','annex','file'])->comment('文件类型');
            $table->enum("disks",['local','public','s3','oss','azure','aliyun','qiniu','upyun','huawei','baidu',])->comment('文件类型');
            $table->string("path",255)->comment('文件路径');
            $table->string("mime_type",128)->comment('文件mimeType');
            $table->char("md5",32)->comment('Md5');
            $table->string("title",100)->comment('文件标题');
            $table->char("folder",20)->comment('文件对象类型');
            $table->string("object_id",64)->comment('文件对象ID');
            $table->string("storage_id",64)->nullable()->comment('文件对象ID');
            $table->integer("size")->default(0)->comment('文件大小');
            $table->smallInteger("width")->default(0)->comment('宽度');
            $table->smallInteger("height")->default(0)->comment('高度');
            $table->mediumInteger("downloads")->default(0)->comment('下载次数');
            $table->enum("public",[0,1])->default(1)->comment("是否公开");
            $table->enum("editor",[0,1])->default(0)->comment("富编辑器图片");
            $table->enum("status",[0,1])->default(0)->comment("附件状态");
            $table->integer("created_op")->default(0)->comment("创建人");
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['md5','type','folder'],'md5_type_folder_unique');
            $table->index('type','type_index');
            $table->index('folder','folder_index');
            $table->index('object_id','object_id_index');
            $table->index('public','public_index');
            $table->index('status','status_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('files');
    }
}
