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
            $table->string('url');
            $table->string('image');
            $table->string('maintainence_message')->nullable();
            $table->string('maintainence_duration')->nullable();
            $table->enum('log_admin_activity', ['Y', 'N']);
            $table->enum('log_admin_invalid_login', ['Y', 'N']);
            $table->string('contact_email', 100);
            $table->string('contact_name', 100);
            $table->string('contact_number', 100);
            $table->enum('mode', ['1', '2','3'])->comment('1=live,2=down,3=maintenance');
            $table->string('maintainence_code', 100)->nullable();
            $table->datetime('maintainence_start_date')->nullable();
            $table->string('facebook_url', 100);
            $table->string('linkedin_url', 100);
            $table->string('twitter_url', 100);
            $table->string('instagram_url', 100);
            $table->string('youtube_url', 100);
            $table->string('github_url', 100);
            $table->string('skype_url', 100);
            $table->string('fb_page_id', 100);
            $table->string('fb_app_id', 100);
            $table->string('timezone', 100);
            $table->string('currency_sign', 100);
            $table->string('currency_code', 100);
            $table->text('google_analytics_code')->nullable();;
            $table->string('address', 100);
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('country', 100);
            $table->float('like_weightage',5,2);
            $table->float('view_weightage',5,2);
            $table->float('comment_weightage',5,2);
            $table->float('share_weightage',5,2);
            $table->integer('sharing_amount');
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
