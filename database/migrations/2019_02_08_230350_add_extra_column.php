<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('event_registrations', function (Blueprint $table) {
            $table->string('type')->default('ONLINE');
         });

        Schema::table('workshop_registrations', function (Blueprint $table) {
            $table->string('type')->default('ONLINE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('event_registrations', function (Blueprint $table) {
            $table->dropColumn('type');
         });

        Schema::table('workshop_registrations', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
