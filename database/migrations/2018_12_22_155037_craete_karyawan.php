<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CraeteKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->increments('id');
            $table->char('id_karyawan', 30)->nullable();
            $table->string('name');
            $table->unsignedInteger('departemen_id')->nullable();
            $table->unsignedInteger('position_id')->nullable();
            $table->unsignedInteger('project_id')->nullable();
            $table->unsignedInteger('homearea_id')->nullable();
            $table->unsignedInteger('assignmentarea_id')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->enum('status',['Aktif', 'Tidak Aktif'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('karyawan', function (Blueprint $table) {
          $table->foreign('departemen_id')->references('id')->on('departemen')->onDelete('cascade');
          $table->foreign('position_id')->references('id')->on('position')->onDelete('cascade');
          $table->foreign('project_id')->references('id')->on('project')->onDelete('cascade');
          $table->foreign('homearea_id')->references('id')->on('area')->onDelete('cascade');
          $table->foreign('assignmentarea_id')->references('id')->on('area')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawan');
    }
}
