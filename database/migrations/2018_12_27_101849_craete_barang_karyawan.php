<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CraeteBarangKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_karyawan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('barang_id')->nullable();
            $table->unsignedInteger('karyawan_id')->nullable();
            $table->dateTime('tgl_diterima')->nullable();
            $table->timestamps();
        });


        Schema::table('barang_karyawan', function (Blueprint $table) {
          $table->foreign('barang_id')->references('id')->on('barang')->onDelete('cascade');
          $table->foreign('karyawan_id')->references('id')->on('karyawan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_karyawan');
    }
}
