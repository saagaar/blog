<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = array(
        	array('name'=>'create','default'=>'1','guard_name'=>'web'),
        	array('name'=>'edit own posts','default'=>'1','guard_name'=>'web'),
        	array('name'=>'edit all posts','default'=>'2','guard_name'=>'web'),
        	array('name'=>'edit posts more then his point','default'=>'2','guard_name'=>'web'),
        	array('name'=>'delete own posts','default'=>'1','guard_name'=>'web'),
        	array('name'=>'delete all posts','default'=>'2','guard_name'=>'web'),
        	array('name'=>'delete posts more then his point','default'=>'2','guard_name'=>'web'),
        	array('name'=>'edit own profile','default'=>'1','guard_name'=>'web'),
        	array('name'=>'edit all profiles','default'=>'2','guard_name'=>'web'),
        	
        );
        DB::table('permissions')->insert($permission);
        $role = array(
        	array('name'=>'author','default'=>'1','guard_name'=>'web'),
        	
        );
        DB::table('roles')->insert($role);
        
    }
}
