<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllhoActivitiesDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allho_activities_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('allho_activities_id');
            $table->unsignedInteger('tools_id');
            $table->timestamps();
        });

        Schema::table('allho_activities_detail', function (Blueprint $table) {
          $table->foreign('allho_activities_id')->references('id')->on('allho_activities')->onDelete('cascade');
          $table->foreign('tools_id')->references('id')->on('tools')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allho_activities_detail');
    }
}
