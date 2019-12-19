<?php

use Illuminate\Database\Seeder;

class LocalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = array(
                "lang" => "en",
                "lang_name" => "English",
                "display" =>"1",
                "created_at" => date("Y-m-d H:i:s")
            );
 		DB::table('locales')->insert($languages);
    }
}
