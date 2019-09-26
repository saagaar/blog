<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::table('admin_users')->insert([
            'username' => 'Admin',
            'email' => 'admin@admin.com',
            'status'   =>'1',
            'invalid_login' =>'0',
            'role_id' => '1',
            'phone' => '9869370501',
            'password' => bcrypt('123456'),
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
