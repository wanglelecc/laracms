<?php

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
        });
	}

	public function down()
	{
		Schema::drop('links');
	}
}
