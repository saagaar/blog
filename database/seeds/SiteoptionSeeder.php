<?php

use Illuminate\Database\Seeder;

class SiteoptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	 DB::table('site_options')->truncate();
    	 
        DB::table('site_options')->insert([
        'site_name'         =>'idata solution',
        'contact_name'      =>'abhishek',
        'contact_email'     =>'abhishekgiri49@hotmail.com',
        'contact_number'    =>'9843425748',
        'maintainence'      =>Str::random(6),
        'facebook_id'       =>'www.facebook.com/idata',
        'linkedin_id'       =>'www.linkedin.com/idata',
        'twitter_id'        =>'www.twitter.com/idata',
        'instagram_id'      =>'www.instagram.com/idata',
        'youtube'           =>'www.youtube.com/idata',
        'timezone'          =>'1',
        'currency_sign'     =>'$',
        'currency_code'     =>'USD',
        'address'           =>'kumaripati',
        'state'             =>'3',
        'country'           =>'126',
        'city'              =>'lalitpur', 
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
