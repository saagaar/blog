<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->timestamps();
            $table->string('title');
            $table->text('content');
            $table->foreign('locale_id')
                    ->references('id')->on('locales')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('locale_id');
            $table->enum('save_method',['1','2'])->comment('1=Save to draft,2-Publish')->default('1');
            $table->enum('featured',['1','0'])->comment('1=yes,2=no');
            $table->enum('anynomous',['1','0'])->comment('1=yes,2-No');
            $table->string('image');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
