<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnToolDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_tool_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('return_tools_id');
            $table->unsignedInteger('tools_id');
            $table->timestamps();
        });

        Schema::table('return_tool_details', function (Blueprint $table) {
          $table->foreign('return_tools_id')->references('id')->on('return_tools')->onDelete('NO ACTION');
          $table->foreign('tools_id')->references('id')->on('tools')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('return_tool_details');
    }
}
