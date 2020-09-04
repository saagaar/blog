<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('activation_code')->nullable();
            $table->datetime('activation_date')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->integer('invalid_login')->default(0);
            $table->enum('status',['1','2','3','4'])->comment('1=active,2=inactive,3-closed,4=suspended')->default('1');
            $table->enum('is_login',['1','2'])->comment('1=active,2=inactive');
            $table->datetime('last_login_date')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('bio')->nullable();
            $table->date('dob')->nullable();
            $table->string('image',300)->nullable();
            $table->string('token',1000)->nullable();
            $table->double('point',10,2);
            $table->double('point_previous',10,2);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
