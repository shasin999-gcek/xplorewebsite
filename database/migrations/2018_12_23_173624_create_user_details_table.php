<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('college_id');
            $table->string('branch');
            $table->string('semester');
            $table->string('mobile_number')->unique();
            $table->boolean('needs_accomodation')->default(false);
            $table->timestamps();

            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('college_id')->references('id')->on('college_lists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->dropForeign('user_details_user_id_foreign');
            $table->dropForeign('user_details_college_id_foreign');
        });
        Schema::dropIfExists('user_details');
    }
}
