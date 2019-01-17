<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentInstaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_instas', function (Blueprint $table) {
        $table->string("order_id");
        $table->string("payment_id");
        $table->string("quantity");
        $table->string("status");
        $table->string("buyer_name");
        $table->string("buyer_phone");
        $table->string("buyer_email");
        $table->string("currency");
        $table->string("unit_price");
        $table->string("amount");
        $table->string("fees");
        $table->string("instrument_type");
        $table->string("billing_instrument")->nullable();
        $table->string("failure")->nullable(); 
        $table->string("created_at");
        $table->primary('order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_insta');
    }
}
