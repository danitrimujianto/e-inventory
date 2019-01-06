<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service', function (Blueprint $table) {
          $table->unsignedInteger('karyawan_id')->nullable();
          $table->foreign('karyawan_id')->references('id')->on('karyawan')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service', function (Blueprint $table) {
            //
        });
    }
}
