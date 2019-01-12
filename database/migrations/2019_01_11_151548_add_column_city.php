<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('allho_activities', function (Blueprint $table) {
          $table->unsignedInteger('tocity_id')->nullable();
          $table->foreign('tocity_id')->references('id')->on('city')->onDelete('NO ACTION');
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
