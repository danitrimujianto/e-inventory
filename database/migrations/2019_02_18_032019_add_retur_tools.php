<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReturTools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retur_tools', function (Blueprint $table) {
            $table->unsignedInteger('delivery_id');
            $table->foreign('delivery_id')->references('id')->on('delivery')->onDelete('NO ACTION');
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
            //
        });
    }
}
