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
            $table->string('code')->nullable();
            $table->string('title');
            $table->text('content');  
            $table->text('short_description')->nullable();       
            $table->unsignedBigInteger('locale_id');        
            $table->foreign('locale_id')
                    ->references('id')->on('locales')
                    ->onDelete('cascade');
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->enum('save_method',['1','2'])->comment('1=Save to draft,2-Publish')->default('1');
            $table->enum('show_in_home',['1', '2'])->comment('1->Active,2->Inactive');
            $table->enum('featured',['1','2'])->comment('1=yes,2=no');
            $table->enum('anynomous',['1','2'])->comment('1=yes,2-No');
            $table->enum('type',['1','2'])->comment('1=private,2=public');
            $table->string('image')->nullable();
            $table->integer('views')->default('0');
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
        Schema::dropIfExists('blogs');
    }
}
