<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnTools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_tools', function (Blueprint $table) {
            $table->increments('id');
            $table->char('kode', 20)->nullable();
            $table->date('tgl')->nullable();
            $table->unsignedInteger('karyawan_id')->nullable();
            $table->unsignedInteger('project_id')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('return_tools', function(Blueprint $table){
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
        Schema::dropIfExists('return_tools');
    }
}
