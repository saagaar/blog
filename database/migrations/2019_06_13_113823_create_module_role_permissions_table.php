4<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_role_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('module_id')
                    ->references('id')->on('module_permissions')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('module_id');
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
        Schema::dropIfExists('admin_role_permissions');
    }
}
