<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsEmailIsActivatedAndEmailActivatedTimeToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('email_is_activated',[0,1])->default(0)->after('email');
            $table->timestamp('email_activated_time')->nullable()->after('email_is_activated');
            $table->enum('sex',[0,1])->default(0)->commit('性别:0男,1女')->after('email_activated_time');
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
            $table->dropColumn('email_is_activated');
            $table->dropColumn('email_activated_time');
            $table->dropColumn('sex');
        });
    }
}
