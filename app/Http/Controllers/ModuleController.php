<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\ModuleInterface;
use App\Repository\ModuleRolePermissionInterface;

class ModuleController extends AdminController
{
    
    protected $modulelist;

    function __construct(ModuleInterface $modules)
    {
        parent::__construct();
        $this->modulelist=$modules;
    }

    public function Manage(ModuleRolePermissionInterface $permissioninterface)
    {
       $this->User = \Auth::user();
       $allmodules= $this->modulelist->getAll();
       $allpermisionbyrole =  $permissioninterface->getModulePermissionListByUserId($this->User->role_id);
      
        $breadcrumb=   [
                            'breadcrumbs'   => [
                            'Dashboard'     =>  route('admin.dashboard'),
                            'Admin roles'   =>  route('adminrole.list'),
                            'current_menu'  =>  'Manage Roles'
                                               ]
                        ];
            $adminrole ='';
            // if ($request->method()=='POST') 
            // {
            //     $requestobj=app(RoleRequest::class);
            //     $validatedData = $requestobj->validated();
            //     $this->roles->update($id,$validatedData);
            //     return redirect()->route('adminrole.list')
            //                     ->with('success','Role Updated successfully.');
            // }    
        return view('permissions.managerolepermision',compact('allmodules','allpermisionbyrole'))->with(array('breadcrumb'=>$breadcrumb));
    }
}
