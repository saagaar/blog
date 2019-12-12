<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
class AssignPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $SingleRole = Role::find(1);
        $authorPermission = array(['1','2','5','8']);
        $SingleRole->givePermissionTo($authorPermission);
    }
}
