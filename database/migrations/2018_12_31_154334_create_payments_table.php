<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->string('ORDERID');
            $table->string('CUST_ID')->nullable();
            $table->string('TXNID');
            $table->string('BANKTXNID');
            $table->string('TXNAMOUNT');
            $table->string('CURRENCY');
            $table->string('STATUS');
            $table->string('RESPCODE');
            $table->text('RESPMSG');
            $table->string('TXNDATE');
            $table->string('GATEWAYNAME');
            $table->string('BANKNAME');
            $table->string('PAYMENTMODE');
            $table->string('BIN_NUMBER')->nullable();
            $table->string('CARD_LAST_NUMS')->nullable();
            $table->primary('ORDERID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
