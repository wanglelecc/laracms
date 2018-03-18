<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::Create('forms', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('object_id')->comment('objectId');
            $table->string('form')->comment('所属表单');
            $table->integer('user_id')->default(0)->comment('用户id');
            $table->ipAddress("ip")->comment('IP');
            $table->json('data')->comment('数据');
            $table->enum("status",[0,1,2])->default(1)->comment('状态');
            $table->timestamps();
            $table->index('form','form_index');
            $table->index('object_id','object_id_index');
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
        Schema::dropIfExists('forms');
    }
}
