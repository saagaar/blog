<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeed::class);       
        $this->call(UserSeed::class);
        $this->call(SiteoptionSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(LocalesSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(CategorySeeder::class);
    }
}
