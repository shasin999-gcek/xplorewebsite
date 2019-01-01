<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('event_id');
            $table->string('order_id');
            $table->boolean('is_reg_success')->default(false);
            $table->timestamps();
        });

        Schema::table('event_registrations', function (Blueprint $table) {
           $table->foreign('user_id')
               ->references('id')
               ->on('users')
               ->onDelete('cascade');

            $table->foreign('event_id')
               ->references('id')
               ->on('events')
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
        Schema::table('event_registrations', function (Blueprint $table) {
           $table->dropForeign('event_registrations_user_id_foreign');
           $table->dropForeign('event_registrations_event_id_foreign');
        });

        Schema::dropIfExists('event_registrations');
    }
}
