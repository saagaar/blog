<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('log_id');
            $table->foreign('log_id')
                    ->references('id')->on('user_logs')
                    ->onDelete('cascade');
             $table->string('referer_url');
            $table->string('user_agent');
            $table->string('redirected_to');
            $table->datetime('visit_date');
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
        Schema::dropIfExists('logdetails');
    }
}
