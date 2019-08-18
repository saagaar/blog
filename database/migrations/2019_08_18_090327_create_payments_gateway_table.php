<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsGatewayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments_gateway', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('email');
            $table->enum('mode',['Y', 'N']);
            $table->String('image');            
            $table->String('api_merchant_key');
            $table->String('api_merchant_password');
            $table->String('api_merchant_signature');
            $table->String('api_version');
            $table->enum('status',['Y', 'N']);
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
        Schema::dropIfExists('payments_gateway');
    }
}
