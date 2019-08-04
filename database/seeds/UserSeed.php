<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_users')->truncate();
            DB::table('admin_users')->insert([
            'username' => 'Admin',
            'email' => 'admin@admin.com',
            'status'   =>'0',
            'role_id' => '1',
            'password' => bcrypt('123456'),
            'created_at' => date("Y-m-d H:i:s")
        ]);
        
    }
}
