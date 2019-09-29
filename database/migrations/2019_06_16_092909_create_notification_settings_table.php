<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()    
    {
        Schema::create('notification_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->string('code', 100)->unique();
            $table->string('view',50)->default('default');
            $table->string('subject', 100);
            $table->longText('email_body');
            $table->longText('sms_body');
            $table->longText('database_body');
            $table->json('notification_type')->comment('mail,database,sms');
            $table->enum('active', ['1', '2'])->comment('1=active,2-inactive')->default('1');;
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
        Schema::dropIfExists('email_settings');
    }
}
