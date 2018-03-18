<?php

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
            $table->string("path",255)->comment('文件路径');
            $table->char("mime_type",30)->comment('文件mimeType');
            $table->char("md5",32)->comment('Md5');
            $table->string("title",100)->comment('文件标题');
            $table->char("folder",20)->comment('文件对象类型');
            $table->string("object_id",64)->comment('文件对象ID');
            $table->integer("size")->default(0)->comment('文件大小');
            $table->smallInteger("width")->default(0)->comment('宽度');
            $table->smallInteger("height")->default(0)->comment('高度');
            $table->mediumInteger("downloads")->default(0)->comment('下载次数');
            $table->enum("public",[0,1])->default(1)->comment("是否公开");
            $table->enum("editor",[0,1])->default(0)->comment("富编辑器图片");
            $table->enum("status",[0,1])->default(0)->comment("附件状态");
            $table->integer("created_op")->default(0)->comment("创建人");
            $table->timestamps();
            $table->unique(['md5','type','folder'],'md5_type_folder_unique');
            $table->index('type','type_index');
            $table->index('folder','folder_index');
            $table->index('object_id','object_id_index');
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
