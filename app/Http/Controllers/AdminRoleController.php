<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController; 
use App\Repository\AdminRoleInterface;
use App\Models\LogAdminActivitys;
use App\Http\Requests\RoleRequest;
class AdminRoleController extends AdminController
{
    protected $adminrole;

    function __construct(AdminRoleInterface $adminrole)
    {
        $this->roles=$adminrole;
        $this->middleware('auth:admin')->except('logout');
       
    }
    public function index()
    {
        $adminroles = $this->roles->getAll()->paginate(5);
        return view('roles.adminrole',compact('adminroles'));
    }
    public function create(RoleRequest $request)
    {
        if ($request->isMethod('post')) {
            $validatedData = $request->validated();
        
        $this->roles->create($validatedData);
        return redirect()->route('adminroles')
                        ->with('success','Roles created successfully.');
        }

       return view('roles.createrole');
    }
    public function destroy($id)
    {
        $adminrole =$this->roles->getroleById($id);
        $adminrole->delete();
        return redirect()->route('adminroles')
        ->with('success', 'Role has been deleted!!');
    }
    public function edit(RoleRequest $request,$id)
    {
        $adminrole =$this->roles->getroleById($id);
        if ($request->isMethod('post')) {
            $validatedData = $request->validated();

            $adminrole->update($validatedData);
            return redirect()->route('adminroles')
                             ->with('success','Role updated successfully.');
        }
        

        return view('roles.editrole',compact('adminrole'));
    }
  
}
