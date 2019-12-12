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
        $this->call(SiteoptionSeeder::class);
        $this->call(RoleSeed::class);       
        $this->call(UserSeed::class);
        $this->call(CountriesSeeder::class);
        $this->call(LocalesSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(ImportModuleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(AssignPermissionSeeder::class);
    }
}
