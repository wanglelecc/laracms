<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLastIpAndLastDateToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_ip')->nullable()->comment('最后一次登录IP');
            $table->string('last_location')->nullable()->comment('最后一次登录地址');
            $table->timestamp('last_time')->nullable()->comment('最后一次登录时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_ip');
            $table->dropColumn('last_location');
            $table->dropColumn('last_time');
        });
    }
}
