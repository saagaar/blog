<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogAdminActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_admin_activitys', function (Blueprint $table) {
            $table->bigIncrements('log_id');
            $table->dateTime('log_time');
            $table->integer('log_userid');
            $table->string('log_usertype', 100);
            $table->string('module_name', 100);
            $table->string('module_desc', 100);
            $table->string('log_action', 100);
            $table->string('log_ip', 100);
            $table->text('log_browser');
            $table->text('log_platform');
            $table->text('log_agent');
            $table->text('log_referer');
            $table->text('log_extra_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_admin_activity');
    }
}
