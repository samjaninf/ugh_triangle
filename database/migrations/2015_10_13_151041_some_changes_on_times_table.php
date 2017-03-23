<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class SomeChangesOnTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publish_times', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->integer('profile_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('publish_times', function (Blueprint $table) {
            $table->dropColumn('profile_id');
            $table->integer('user_id')->after('id');
        });
    }
}
