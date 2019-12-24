<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('parent_id')
                    ->references('id')->on('categories')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name');
            $table->String('description')->nullable();
            $table->string('slug')->unique();
            $table->string('banner_image')->nullable();
            $table->enum('show_in_home',['1', '2'])->comment('1->Active,2->Inactive');
            $table->integer('priority')->default(0);
            $table->enum('status', ['1', '2'])->comment('1->Active,2->Inactive');
            $table->string('meta_title');
            $table->string('meta_keyword');
            $table->string('meta_description');
            $table->text('schema1');
            $table->text('schema2');
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
        Schema::dropIfExists('categories');
    }
}
