<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToolsKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tools_karyawan', function (Blueprint $table) {
          $table->unsignedInteger('allho_activities_id')->nullable();
          $table->foreign('allho_activities_id')->references('id')->on('allho_activities')->onDelete('NO ACTION');
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
