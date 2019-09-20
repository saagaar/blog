4<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_role_permission', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('permission_id')
                    ->references('id')->on('admin_permissions')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('permission_id');
            $table->foreign('role_id')
                    ->references('id')->on('admin_roles')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
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
        Schema::dropIfExists('module_role_permission');
    }
}
