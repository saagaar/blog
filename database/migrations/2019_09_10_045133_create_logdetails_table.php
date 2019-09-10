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
        Schema::create('logdetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('userlogs_id');
            $table->foreign('userlogs_id')
                    ->references('id')->on('userlogs')
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
