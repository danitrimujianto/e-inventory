<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code', 30);
            $table->string('name')->nullable();
            $table->unsignedInteger('area_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->enum('status',['Aktif', 'Tidak Aktif'])->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('warehouse', function (Blueprint $table) {
          $table->foreign('area_id')->references('id')->on('area')->onDelete('cascade');
          $table->foreign('city_id')->references('id')->on('city')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouse');
    }
}
