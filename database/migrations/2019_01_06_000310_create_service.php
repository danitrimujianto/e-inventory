<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('tools_id')->nullable();
          $table->date('start_date')->nullable();
          $table->date('finish_date')->nullable();
          $table->text('problem')->nullable();
          $table->text('service')->nullable();
          $table->unsignedInteger('condition_id')->nullable();
          $table->unsignedInteger('after_id')->nullable();
          $table->text('remarks')->nullable();
          $table->timestamps();
        });

        Schema::table('service', function(Blueprint $table){
          $table->foreign('tools_id')->references('id')->on('tools')->onDelete('NO ACTION');
          $table->foreign('condition_id')->references('id')->on('goods_condition')->onDelete('NO ACTION');
          $table->foreign('after_id')->references('id')->on('goods_condition')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service');
    }
}
