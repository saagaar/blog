<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogAdminInvalidLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_admin_invalid_logins', function (Blueprint $table) {
            $table->bigIncrements('log_id');
            $table->dateTime('log_time');
            $table->string('log_username', 100);
            $table->string('log_password', 100);
            $table->string('log_module', 100);
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
        Schema::dropIfExists('log_admin_invalid_logins');
    }
}
