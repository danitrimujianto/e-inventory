<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseRequestDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_request_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('purchase_request_id')->nullable();
            $table->string('item')->nullable();
            $table->string('merk')->nullable();
            $table->string('type')->nullable();
            $table->double('quantity')->nullable();
            $table->double('price')->nullable();
            $table->double('total')->nullable();
            $table->timestamps();
        });

        Schema::table('purchase_request_detail', function (Blueprint $table) {
          $table->foreign('purchase_request_id')->references('id')->on('purchase_request')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_request_detail');
    }
}
