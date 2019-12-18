<?php

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::table('roles')->insert([
            'name' => 'writer',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
