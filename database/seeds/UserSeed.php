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
            DB::table('users')->insert([
            'name'=>'user',
            'username'=>'user123',
            'email'=>'user123@gmail.com',
            'status'   =>'1',
            'invalid_login' =>'0',
            'phone' => '9813953180',
            'password' => bcrypt('123456'),
            'created_at' => date("Y-m-d H:i:s")
        ]);

        
    }
}
