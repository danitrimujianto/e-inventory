<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomefieldAllhoActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('allho_activities', function (Blueprint $table) {
            $table->enum('status', ['0', '1', '2', '99']);
            $table->text('keterangan_batal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('allho_activities', function (Blueprint $table) {
            //
        });
    }
}
