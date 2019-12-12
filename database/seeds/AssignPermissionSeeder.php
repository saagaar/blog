<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permissions;
class AssignPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::where('default','1')->get();
        foreach ($roles as  $SingleRole) {
           $authorPermission = Permissions::where('default','1')->pluck('id');
            $SingleRole->givePermissionTo($authorPermission);
        }
        
    }
}
