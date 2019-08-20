<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
// use App\Models\Roles;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\RoleInterface;
use App\Repository\PermissionInterface;
use App\Http\Requests\UserRoleRequest;
class RolesController extends AdminController
{
   protected $role;
   protected $permission;
    function __construct(RoleInterface $role,PermissionInterface $permission)
    {
        parent::__construct();
        $this->roles=$role;
        $this->userpermissions=$permission;
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
        return view('admin.userroles.listroles')->with(array('roles'=>$roles,'breadcrumb'=>$breadcrumbs));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs'  => [
                     'Dashboard'     => route('admin.dashboard'),
                     'Admin Roles'   => route('roles.list'),
                     'current_menu'  =>'Create Account roles',
                    ]];
        $userpermission = $this->userpermissions->getAll()->get();
        // dd($userpermission);
        if ($request->method()=='POST') 
        {
            // $request=::class;
            $requestobj=app(UserRoleRequest::class);
            // dd($requestobj);
            $validatedData = $requestobj->validated();
            $rr = $this->roles->create($requestobj->except('permission'));
            $permissions = $requestobj->input('permission') ? $requestobj->input('permission') : [];
            $rr->givePermissionTo($permissions);

            return redirect()->route('roles.list')
                        ->with('success','Roles created successfully.');
        }
       return view('admin.userroles.addroles')->with(array('breadcrumb'=>$breadcrumb,'permissions'=>$userpermission));
    }
    public function edit(Request $request,$id)
    {
      $breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'Users Roles' => route('roles.list'),
                'current_menu'=>'Edit Users Roles',
                  ]];
        $userpermission = $this->userpermissions->getAll()->get();
        $role =$this->roles->getroleById($id);
        if ($request->method()=='POST') 
        {
            $requestobj=app(UserRoleRequest::class);
            $validatedData = $requestobj->validated();
            $role->update($requestobj->except('permission'));
            $permissions = $request->input('permission') ? $request->input('permission') : [];
            // dd($permissions);
            $role->syncPermissions($permissions);
            return redirect()->route('roles.list')
                        ->with('success','Roles edited successfully.');
        }
        return view('admin.userroles.editrole')->with(array('breadcrumb'=>$breadcrumb,'role'=>$role,'permissions'=>$userpermission));;
    }
    public function delete($id)
    {
        $del = $this->roles->getroleById($id);
        // dd($del);
        $del->delete();
        return redirect()->route('roles.list')
        ->with('success', 'Roles has been deleted!!');
    }
}
