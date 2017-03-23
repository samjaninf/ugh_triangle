<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePublishTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publish_times', function (Blueprint $t) {
            $t->increments('id');
            $t->tinyInteger('day');
            $t->tinyInteger('hour');
            $t->tinyInteger('minute');
            $t->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('publish_times');
    }
}
