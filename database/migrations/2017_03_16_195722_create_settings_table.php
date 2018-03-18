<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string("owner",30)->comment('所属');
            $table->string("module",30)->comment('模块');
            $table->string("section",30)->comment('部分');
            $table->string("key",30)->comment('键');
            $table->text("value")->comment('值');
            $table->unique(['owner','module','section','key'],'owner_and_module_and_section_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');
    }
}
