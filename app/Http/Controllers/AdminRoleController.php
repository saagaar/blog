<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController; 
use App\Repository\AdminRoleInterface;
use App\Models\LogAdminActivitys;
use App\Http\Requests\RoleRequest;
use App;
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
        $adminroles = $this->roles->getAll()->paginate($this->PerPage);
        return view('roles.adminrole',compact('adminroles'));
    }
    public function create(Request $request )
    {
        if ($request->method()=='POST') {

            // $request=::class;
            $requestobj=app(RoleRequest::class);
            $validatedData = $requestobj->validated();
        
        // $this->roles->create($validatedData);
        // return redirect()->route('adminroles')
        //                 ->with('success','Roles created successfully.');
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