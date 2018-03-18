<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelHasCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_has_category', function (Blueprint $table) {
            $table->integer("category_id")->unsigned();
            $table->morphs('model');

            $table->foreign('category_id')
                ->references('id')
                ->on('categorys')
                ->onDelete('cascade')
                ->onUpdate('RESTRICT');

            $table->primary(['category_id', 'model_id', 'model_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('model_has_category');
    }
}
