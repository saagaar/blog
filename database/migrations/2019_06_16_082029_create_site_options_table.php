<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('site_name', 100);
            $table->enum('log_admin_activity', ['Y', 'N']);
            $table->enum('log_admin_invalid_login', ['Y', 'N']);
            $table->string('contact_email', 100);
            $table->string('contact_name', 100);
            $table->string('contact_number', 100);
            $table->enum('mode', ['1', '2','3'])->comment('1=live,2=down,3=maintenance');
            $table->string('maintainence', 100);
            $table->string('facebook_id', 100);
            $table->string('linkedin_id', 100);
            $table->string('twitter_id', 100);
            $table->string('instagram_id', 100);
            $table->string('youtube', 100);
            $table->string('timezone', 100);
            $table->string('currency_sign', 100);
            $table->string('currency_code', 100);
            $table->string('google_analytics_code', 100)->nullable();;
            $table->string('address', 100);
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('country', 100);
            $table->enum('blog_requires_activation', ['Y','N']);
            $table->enum('user_requires_activation', ['Y','N']);
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
        Schema::dropIfExists('site_options');
    }
}
