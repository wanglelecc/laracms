<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMultipleFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multiple_files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("multiple_file_table_id");
            $table->string("multiple_file_table_type");
            $table->string("field");
            $table->integer("order")->default(0)->comment("排序");
            $table->string("path",255)->nullable()->comment("路径");
            $table->timestamps();
            $table->index('multiple_file_table_type','multiple_file_table_type_index');
            $table->index('multiple_file_table_id','multiple_file_table_id_index');
            $table->index('field','field_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multiple_files');
    }
}
