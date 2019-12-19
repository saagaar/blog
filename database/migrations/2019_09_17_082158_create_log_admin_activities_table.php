<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogAdminActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_admin_activities', function (Blueprint $table) {
            $table->bigIncrements('log_id');
            $table->dateTime('log_time');
            $table->integer('logable_id');
            $table->string('logable_type', 100);
            $table->string('log_action', 100);
            $table->string('log_ip', 100);
            $table->text('log_browser');
            $table->text('log_platform');
            $table->text('log_agent');
            $table->text('log_referer');
            $table->text('log_extra_info');
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
        Schema::dropIfExists('log_admin_activities');
    }
}
