<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('short_name')->unique();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('events', function (Blueprint $table) {
           $table->foreign('category_id')
               ->references('id')
               ->on('categories')
               ->onDelete('cascade');
        });

         Schema::table('workshops', function (Blueprint $table) {
           $table->foreign('category_id')
               ->references('id')
               ->on('categories')
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
        Schema::table('events', function (Blueprint $table) {
           $table->dropForeign('events_category_id_foreign');
        });

        Schema::dropIfExists('categories');
    }
}
