<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController; 
use App\Repository\RoleInterface;
use App\Repository\PermissionInterface;
use App\Http\Requests\UserRoleRequest;
class RolesController extends AdminController
{
   protected $role;
    function __construct(RoleInterface $role,PermissionInterface $permission)
    {
        parent::__construct();
        $this->roles=$role;
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
        return view('userroles.listroles')->with(array('roles'=>$roles,'breadcrumb'=>$breadcrumbs));
    }
    public function create()
    {
        $breadcrumb=['breadcrumbs'  => [
                     'Dashboard'     => route('admin.dashboard'),
                     'Admin Roles'   => route('role.list'),
                     'current_menu'  =>'Create Account roles',
                    ]];
        if ($request->method()=='POST') 
        {
            // $request=::class;
            $requestobj=app(UserRoleRequest::class);
            $validatedData = $requestobj->validated();
            $this->roles->create($validatedData->except('permission'));
            $permissions = $request->input('permission') ? $request->input('permission') : [];
            $this->roles->givePermissionTo($permissions);

            return redirect()->route('role.list')
                        ->with('success','Roles created successfully.');
        }
       return view('userroles.createrole')->with(array('breadcrumb'=>$breadcrumb));
    }
    public function edit(Request $request,$id)
    {
      $breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'Users Roles' => route('role.list'),
                'current_menu'=>'Edit Users Roles',
                  ]];
        $role =$this->roles->getById($id);
        if ($request->method()=='POST') 
        {
            $requestobj=app(UserRoleRequest::class);
            $validatedData = $requestobj->validated();
            $this->roles->update($id,$validatedData->except('permission'));
            $permissions = $request->input('permission') ? $request->input('permission') : [];
            $this->roles->syncPermissions($permissions);
            return redirect()->route('role.list')
                        ->with('success','Roles edited successfully.');
        }
        return view('account.edituser',compact('breadcrumb','role'));
    }
    public function delete($id)
    {
        $role =$this->roles->getById($id);
        $role->delete();
        return redirect()->route('role.list')
        ->with('success', 'Roles has been deleted!!');
    }
}
