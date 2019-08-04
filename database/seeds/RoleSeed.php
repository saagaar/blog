<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
         DB::table('admin_roles')->insert([
            'role_name' => 'superadmin',
            'slug' => 'superadmin',
            'status' =>'0',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
