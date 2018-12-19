<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropIdUsertype extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function (Blueprint $table) {

        $table->dropForeign('users_id_usertype_foreign');
        $table->dropColumn('id_usertype');
        $table->dropColumn('usertype_id');
        // 
        // $table->unsignedInteger('usertype_id');
        // $table->foreign('usertype_id')->references('id')->on('usertype')->onDelete('CASCADE');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
