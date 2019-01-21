<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //


        Schema::table('events', function (Blueprint $table) {
            $table->boolean('is_reg_closed')->default(false);
         });

        Schema::table('workshops', function (Blueprint $table) {
            $table->boolean('is_reg_closed')->default(false);
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

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('is_reg_closed');
         });

        Schema::table('workshops', function (Blueprint $table) {
            $table->dropColumn('is_reg_closed');
        });
    }
}
