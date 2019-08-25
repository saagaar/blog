<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('email');
            $table->enum('payment_gateway',['paypal', 'ipay']);
            $table->enum('mode',['1', '0']);
            $table->String('image');            
            $table->String('api_merchant_key');
            $table->String('api_merchant_password');
            $table->String('api_merchant_signature');
            $table->String('api_version');
            $table->enum('status',['1', '0']);
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
        Schema::dropIfExists('payment_gateways');
    }
}
