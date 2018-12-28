<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllhoActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allho_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('delivery_id');
            $table->unsignedInteger('goods_condition_id');
            $table->unsignedInteger('fromarea_id');
            $table->unsignedInteger('toarea_id');
            $table->unsignedInteger('recipient_id');
            $table->unsignedInteger('project_id');
            $table->date('tgl');
            $table->char('outgoing_no', 50);
            $table->char('receipt_no', 50);
            $table->char('type', 50);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('allho_activities', function (Blueprint $table) {
          $table->foreign('delivery_id')->references('id')->on('delivery')->onDelete('cascade');
          $table->foreign('goods_condition_id')->references('id')->on('goods_condition')->onDelete('cascade');
          $table->foreign('fromarea_id')->references('id')->on('area')->onDelete('cascade');
          $table->foreign('toarea_id')->references('id')->on('area')->onDelete('cascade');
          $table->foreign('recipient_id')->references('id')->on('karyawan')->onDelete('cascade');
          $table->foreign('project_id')->references('id')->on('project')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allho_activities');
    }
}
