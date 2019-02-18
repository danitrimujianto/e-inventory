<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropForeignReturnTools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retur_tools', function (Blueprint $table) {
          $table->dropForeign('return_tools_karyawan_id_foreign');
          $table->dropForeign('return_tools_project_id_foreign');
          $table->foreign('karyawan_id')->references('id')->on('karyawan')->onDelete('NO ACTION');
          $table->foreign('project_id')->references('id')->on('project')->onDelete('NO ACTION');
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
          $table->dropForeign('return_tools_karyawan_id_foreign');
          $table->dropForeign('return_tools_project_id_foreign');
          $table->foreign('karyawan_id')->references('id')->on('karyawan')->onDelete('NO ACTION');
          $table->foreign('project_id')->references('id')->on('project')->onDelete('NO ACTION');
        });
    }
}
