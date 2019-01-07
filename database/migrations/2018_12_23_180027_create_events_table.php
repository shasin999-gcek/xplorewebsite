<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->string('name');
            $table->text('description');
            $table->string('reg_fee');
            $table->string('type');  // Team or individual
            $table->string('poster_image'); // poster image name (default storage path)
            $table->string('thumbnail_image'); // Thumbnail image
            $table->string('pdf_path');
            $table->string('f_price_money')->default('Rs 0');
            $table->string('s_price_money')->default('Rs 0');
            $table->string('t_price_money')->default('Rs 0');
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
