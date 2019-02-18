<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColoumnAtReturTools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retur_tools', function (Blueprint $table) {
            $table->char('status', 2)->default(0);
            $table->date('accept_date')->nullable();
            $table->unsignedInteger('accepted_by')->nullable();
            $table->foreign('accepted_by')->references('id')->on('karyawan')->onDelete('NO ACTION');
            $table->unsignedInteger('delivery_id')->nullable();
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
            $table->char('status', 2)->default(0);
            $table->date('accept_date')->nullable();
            $table->unsignedInteger('accepted_by')->nullable();
            $table->foreign('accepted_by')->references('id')->on('karyawan')->onDelete('NO ACTION');
            $table->unsignedInteger('delivery_id')->nullable();
            $table->foreign('delivery_id')->references('id')->on('delivery')->onDelete('NO ACTION');
        });
    }
}
