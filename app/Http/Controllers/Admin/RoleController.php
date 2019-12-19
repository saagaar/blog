<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\RoleInterface;
use App\Repository\PermissionInterface;
use App\Http\Requests\UserRoleRequest;
class RoleController extends AdminController
{
   protected $role;
   protected $permission;
    function __construct(RoleInterface $role,PermissionInterface $permission)
    {
        parent::__construct();
        $this->roles=$role;
        $this->userPermissions=$permission;
        $this->middleware('auth:admin')->except('logout');
    }
    public function list(Request $request)
    {
        $breadcrumbs=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'current_menu'=>'Account roles',
                     ]];
        $search = $request->get('search');
        if($search){
            $roles = $this->roles->getAll()
                ->where('name', 'like', '%' . $search . '%')
                ->paginate($this->PerPage)
                ->withPath('?search=' . $search);
        }else{
           $roles = $this->roles->getAll()->paginate($this->PerPage);
        }
        return view('admin.userrole.list')->with(array('roles'=>$roles,'breadcrumb'=>$breadcrumbs,'primary_menu'=>'role.list'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs'  => [
                     'Dashboard'     => route('admin.dashboard'),
                     'Admin Roles'   => route('roles.list'),
                     'current_menu'  =>'Create Account roles',
                    ]];
        $userPermission = $this->userPermissions->getAll()->get();
        if ($request->method()=='POST') 
        {
            $requestObj=app(UserRoleRequest::class);
            $validatedData = $requestObj->validated();
            $role = $this->roles->create($requestObj->except('permission'));
            $permissions = $requestObj->input('permission') ? $requestObj->input('permission') : [];
            $role->givePermissionTo($permissions);

            return redirect()->route('roles.list')
                        ->with('success','Roles created successfully.');
        }
       return view('admin.userrole.create')->with(array('breadcrumb'=>$breadcrumb,'permissions'=>$userPermission,'primary_menu'=>'role.list'));
    }
    public function edit(Request $request,$id)
    {
      $breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'Users Roles' => route('roles.list'),
                'current_menu'=>'Edit Users Roles',
                  ]];
        $userPermission = $this->userPermissions->getAll()->get();
        $role =$this->roles->getroleById($id);
        if ($request->method()=='POST') 
        {
            $requestObj=app(UserRoleRequest::class);
            $validatedData = $requestObj->validated();
            $role->update($requestObj->except('permission'));
            $permissions = $request->input('permission') ? $request->input('permission') : [];
            $role->syncPermissions($permissions);
            return redirect()->route('roles.list')
                        ->with('success','Roles edited successfully.');
        }
        return view('admin.userrole.edit')->with(array('breadcrumb'=>$breadcrumb,'role'=>$role,'permissions'=>$userPermission,'primary_menu'=>'role.list'));;
    }
    public function delete($id)
    {
        $del = $this->roles->getroleById($id);
        $del->delete();
        return redirect()->route('roles.list')
        ->with('success', 'Roles has been deleted!!');
    }
}
