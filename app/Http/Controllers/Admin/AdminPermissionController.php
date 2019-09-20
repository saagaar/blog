<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repository\AdminPermissionInterface;
use App\Repository\AdminRolePermissionInterface;
use Illuminate\Foundation\Http\FormRequest;

class AdminPermissionController extends AdminController
{
    
    protected $permissionList;

    function __construct(AdminPermissionInterface $permission)
    {
        parent::__construct();
        $this->permissionList=$permission;
    }

    public function Manage($roleid=false,AdminRolePermissionInterface $permissioninterface,Request $request)
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
			$permissionInterface->RemovePermission($roleid) ;

			$permissionInterface->create($finalarr);
              return redirect()->route('adminrole.managepermission',$roleid)
                            ->with('success','Permission set successfully.');
        }
       $allPermission= $this->permissionList->getAll()->groupBy('name')->toArray();
       $allPermisionByRole =  $permissionInterface->getModulePermissionListByUserId($roleid)->pluck('module_id')->toArray();
      
        $breadcrumb=   [
                            'breadcrumbs'   => [
                            'Dashboard'     =>  route('admin.dashboard'),
                            'Admin roles'   =>  route('adminrole.list'),
                            'current_menu'  =>  'Manage Roles'
                                               ]
                        ];
             
        return view('admin.adminpermission.managerolepermision',compact('allPermission','allPermisionByRole','roleid'))->with(array('breadcrumb'=>$breadcrumb));
    }
}
