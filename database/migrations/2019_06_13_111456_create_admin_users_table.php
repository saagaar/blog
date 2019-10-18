<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->integer('invalid_login')->default(0);
            $table->enum('status', ['1', '2'])->comment('1->Active,2->Inactive');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')
                    ->references('id')->on('admin_roles')
                    ->onDelete('cascade');
            $table->timestamps();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users');
    }
}
