<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWeiboIdAndQqIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('weibo_id')->unique()->nullable()->comment('微博openid')->after('weixin_unionid');
            $table->string('qq_id')->unique()->nullable()->comment('QQopenid')->after('weibo_id');
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
            $table->dropColumn('weibo_id');
            $table->dropColumn('qq_id');
        });
    }
}
