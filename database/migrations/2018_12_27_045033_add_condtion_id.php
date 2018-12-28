<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCondtionId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('allho_activities_detail', function (Blueprint $table) {
          $table->unsignedInteger('goods_condition_id')->nullable();
          $table->foreign('goods_condition_id')->references('id')->on('goods_condition')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('allho_activities_detail', function (Blueprint $table) {
            //
        });
    }
}
