<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Repository\ModuleInterface;
use App\Repository\ModuleRolePermissionInterface;
use Illuminate\Foundation\Http\FormRequest;

class ModuleController extends AdminController
{
    
    protected $modulelist;

    function __construct(ModuleInterface $modules)
    {
        parent::__construct();
        $this->modulelist=$modules;
    }

    public function Manage($roleid=false,ModuleRolePermissionInterface $permissioninterface,Request $request)
    {
    	
       $this->User = \Auth::user();
       if(!$roleid) $roleid=$this->User->role_id;
       /**
       * Handle post form submision for setting permission to role
       **/
       if ($request->method()=='POST') 
        {
        	$validated =$request->validate([
										    	'module_id' => 'required|min:1'
									   	   ]);
        	$data=array();
        	foreach ($validated['module_id'] as $key => $value) 
        	{
        		$data['module_id']=$value;
        		$data['role_id']=$roleid;
        		$finalarr[]=$data;
        	}
            
        	/***
        	*before inserting all new permission array 
        		 delete all that were set previous
        	*/
			$permissioninterface->RemovePermission($roleid) ;

			$permissioninterface->create($finalarr);
              return redirect()->route('adminrole.managepermission',$roleid)
                            ->with('success','Permission set successfully.');
        }
       $allmodules= $this->modulelist->getAll()->groupBy('name')->toArray();
       $allpermisionbyrole =  $permissioninterface->getModulePermissionListByUserId($roleid)->pluck('module_id')->toArray();
      
        $breadcrumb=   [
                            'breadcrumbs'   => [
                            'Dashboard'     =>  route('admin.dashboard'),
                            'Admin roles'   =>  route('adminrole.list'),
                            'current_menu'  =>  'Manage Roles'
                                               ]
                        ];
             
        return view('permissions.managerolepermision',compact('allmodules','allpermisionbyrole','roleid'))->with(array('breadcrumb'=>$breadcrumb));
    }
}
