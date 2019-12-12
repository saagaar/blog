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
        	array('name'=>'create','guard_name'=>'web'),
        	array('name'=>'edit own posts','guard_name'=>'web'),
        	array('name'=>'edit all posts','guard_name'=>'web'),
        	array('name'=>'edit posts more then his point','guard_name'=>'web'),
        	array('name'=>'delete own posts','guard_name'=>'web'),
        	array('name'=>'delete all posts','guard_name'=>'web'),
        	array('name'=>'delete posts more then his point','guard_name'=>'web'),
        	array('name'=>'edit own profile','guard_name'=>'web'),
        	array('name'=>'edit all profiles','guard_name'=>'web'),
        	
        );
        DB::table('permissions')->insert($permission);
        $role = array(
        	array('name'=>'author','guard_name'=>'web'),
        	
        );
        DB::table('roles')->insert($role);
        
    }
}
