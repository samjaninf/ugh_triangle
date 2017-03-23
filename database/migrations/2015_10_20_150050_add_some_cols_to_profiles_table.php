<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSomeColsToProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $t) {
            $t->string('watermark');
            $t->string('w_height');
            $t->string('w_width');
            $t->integer('w_pos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $t) {
            $t->dropColumn('watermark');
            $t->dropColumn('w_height');
            $t->dropColumn('w_width');
            $t->dropColumn('w_pos');
        });
    }
}
