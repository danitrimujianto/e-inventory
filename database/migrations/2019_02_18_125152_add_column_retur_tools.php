<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnReturTools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retur_tools', function (Blueprint $table) {
          $table->date('rejected_date')->nullable();
          $table->unsignedInteger('rejected_by')->nullable();
          $table->text('keterangan_batal')->nullable();
          $table->foreign('rejected_by')->references('id')->on('karyawan')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('retur_tools', function (Blueprint $table) {
          $table->date('rejected_date')->nullable();
          $table->unsignedInteger('rejected_by')->nullable();
          $table->text('keterangan_batal')->nullable();
          $table->foreign('rejected_by')->references('id')->on('karyawan')->onDelete('NO ACTION');
        });
    }
}
