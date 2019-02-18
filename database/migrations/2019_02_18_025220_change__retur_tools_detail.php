<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeReturToolsDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retur_tools_detail', function (Blueprint $table) {
            $table->unsignedInteger('retur_tools_id');
            $table->unsignedInteger('goods_condition_id');
            $table->foreign('retur_tools_id')->references('id')->on('retur_tools')->onDelete('NO ACTION');
            $table->foreign('tools_id')->references('id')->on('tools')->onDelete('NO ACTION');
            $table->foreign('goods_condition_id')->references('id')->on('goods_condition')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('retur_tools_detail', function (Blueprint $table) {
            $table->dropForeign('return_tool_details_return_tools_id_foreign');
            $table->dropForeign('return_tool_details_tools_id_foreign');
            $table->dropColumn('return_tools_id');
            $table->unsignedInteger('retur_tools_id');
            $table->unsignedInteger('good_condition_id');
            $table->foreign('retur_tools_id')->references('id')->on('retur_tools')->onDelete('NO ACTION');
            $table->foreign('good_condition_id')->references('id')->on('good_condition')->onDelete('NO ACTION');
        });
    }
}
