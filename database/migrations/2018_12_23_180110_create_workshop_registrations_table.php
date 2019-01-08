<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshop_registrations', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('workshop_id');
            $table->string('order_id');
            $table->boolean('is_reg_success')->default(false);
            $table->timestamps();
        });

        Schema::table('workshop_registrations', function (Blueprint $table) {
           $table->foreign('user_id')
               ->references('id')
               ->on('users')
               ->onDelete('cascade');

            $table->foreign('workshop_id')
               ->references('id')
               ->on('workshops')
               ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workshop_registrations', function (Blueprint $table) {
            $table->dropForeign('workshop_registrations_user_id_foreign');
            $table->dropForeign('workshop_registrations_workshop_id_foreign');
         });
 
         Schema::dropIfExists('workshop_registrations');
    }
}
