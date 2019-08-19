<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlocklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocklists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip_address');
            $table->string('message');
            $table->enum('status',['black','white','grey']);
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')
                    ->references('id')->on('admin_users')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('blocklists');
    }
}
