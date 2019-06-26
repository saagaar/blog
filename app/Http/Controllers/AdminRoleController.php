<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController; 
use App\Repository\AdminRoleInterface;
use App\Models\AdminRoles;
use App\Models\LogAdminActivitys;
use App\Http\Requests\RoleRequest;
class AdminRoleController extends AdminController
{
    protected $roles;


    function __construct(AdminRoleInterface $adminrole)
    {
        parent::__construct();
        $this->roles=$adminrole;
        // $this->middleware('auth:admin')->except('logout');
       
    }
    public function index()
    {

        $adminroles = $this->roles->getAll()->paginate(5);
        return view('roles.adminrole',compact('adminroles'));
    }
    public function create()
    {
        $current_menu="create-roles";
       return view('roles.createrole',compact('current_menu'));
    }
    public function store(RoleRequest $request)
    {
        $validatedData = $request->validated();
        
        $this->roles->create($validatedData);
        return redirect()->route('adminroles')
                        ->with('success','Roles created successfully.');
        
        
    }
    public function destroy($id)
    {
        $adminrole =$this->roles->getroleById($id);
        $adminrole->delete();
        return redirect()->route('adminroles')
        ->with('success', 'Role has been deleted!!');
    }
    public function edit($id)
    {

        $adminrole =$this->roles->getroleById($id);
        return view('roles.editrole',compact('adminrole'));
    }
  
    public function update(RoleRequest $request,$id)
    {
        $adminroles =$this->roles->getroleById($id);
        $validatedData = $request->validated();

        $adminroles->update($validatedData);
        return redirect()->route('adminroles')
                         ->with('success','Role updated successfully.');
    }
}
