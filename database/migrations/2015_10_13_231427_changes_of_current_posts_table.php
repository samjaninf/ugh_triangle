<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangesOfCurrentPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('publish_time');
            $table->string('time', 12);
            $table->integer('ptime');
            $table->dropColumn('user_id');
            $table->integer('profile_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('publish_time', 12);
            $table->dropColumn('time');
            $table->dropColumn('ptime');
            $table->integer('user_id');
            $table->dropColumn('profile_id');
        });
    }
}
