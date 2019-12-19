<?php

use Illuminate\Database\Seeder;
class ImportModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ctrl = new \App\Http\Controllers\Admin\AdminController();
		$ctrl->importmodules();
    }
}
