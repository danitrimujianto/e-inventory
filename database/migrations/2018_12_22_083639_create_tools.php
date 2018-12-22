<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl')->nullable();
            $table->unsignedInteger('division_id')->nullable();
            $table->unsignedInteger('barang_id')->nullable();
            $table->char('code', 30)->nullable();
            $table->string('item')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('imei')->nullable();
            $table->double('price')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('tools', function (Blueprint $table) {
          $table->foreign('division_id')->references('id')->on('division')->onDelete('cascade');
          $table->foreign('barang_id')->references('id')->on('barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tools');
    }
}
