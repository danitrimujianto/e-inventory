<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnToolsKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tools_karyawan', function (Blueprint $table) {
          $table->dropForeign('barang_karyawan_barang_id_foreign');
          $table->dropForeign('barang_karyawan_goods_condition_id_foreign');
          $table->dropForeign('barang_karyawan_karyawan_id_foreign');
          $table->dropColumn('barang_id');
          $table->unsignedInteger('tools_id');
          $table->foreign('tools_id')->references('id')->on('tools')->onDelete('cascade');
          $table->foreign('karyawan_id')->references('id')->on('karyawan')->onDelete('cascade');
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
        Schema::table('tools_karyawan', function (Blueprint $table) {
            //
        });
    }
}
