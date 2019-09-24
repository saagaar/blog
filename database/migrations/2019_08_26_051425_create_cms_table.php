<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('heading', 100);
            $table->longText('content');
            $table->string('cms_slug', 100);
            $table->string('page_title', 100);
            $table->string('meta_key', 100);
            $table->string('meta_description', 100);
            $table->enum('status', ['1', '2'])->comment('1->Active,2->Inactive');
            $table->enum('cms_type', ['website', 'system']);
            $table->enum('deletable', ['Y', 'N']);
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
        Schema::dropIfExists('cms');
    }
}
