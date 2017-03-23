<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPtimeColToPubQueueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publishing_queue', function (Blueprint $table) {
            $table->integer('ptime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('publishing_queue', function (Blueprint $table) {
            $table->dropColumn('ptime');
        });
    }
}
