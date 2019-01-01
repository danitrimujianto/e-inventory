<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_request', function (Blueprint $table) {
            $table->increments('id');
            $table->char('pr_no', 20)->nullable();
            $table->unsignedInteger('karyawan_id')->nullable();
            $table->date('tanggal')->nullable();
            $table->char('type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('purchase_request', function (Blueprint $table) {
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
        Schema::dropIfExists('purchase_request');
    }
}
