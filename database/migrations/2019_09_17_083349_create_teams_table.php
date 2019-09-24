<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('name');
            $table->String('position');
            $table->String('description');
            $table->String('linkedin_url');
            $table->String('facebook_url');
            $table->String('twitter_url');
            $table->String('github_url');
            $table->String('image');
           $table->enum('status', ['1', '2'])->comment('1->Active,2->Inactive');
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
        Schema::dropIfExists('teams');
    }
}
