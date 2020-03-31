<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pageid')->nullable();
            $table->string('page_slug');
            $table->string('meta_title');
            $table->string('meta_key');
            $table->string('meta_description')->nullable();
            $table->string('image')->nullable();
            $table->string('schema1')->nullable();
            $table->string('schema2')->nullable();
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
        Schema::dropIfExists('seos');
    }
}
