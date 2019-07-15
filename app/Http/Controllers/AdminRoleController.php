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
        parent::__construct();
        $this->roles=$adminrole;
        $this->middleware('auth:admin')->except('logout');
       
    }
    public function list()
    {
        $breadcrumbs=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'current_menu'=>'Admin roles',
                     ]];
        $adminroles = $this->roles->getAll()->paginate($this->PerPage);
        return view('roles.adminrole')->with(array('adminroles'=>$adminroles,'breadcrumb'=>$breadcrumbs));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'Admin Roles' => route('adminrole.list'),
                    'current_menu'=>'Create',
                      ]];
        if ($request->method()=='POST') {

            // $request=::class;
            $requestobj=app(RoleRequest::class);
            $validatedData = $requestobj->validated();
        
        $this->roles->create($validatedData);
        return redirect()->route('adminrole.list')
                        ->with('success','Roles created successfully.');
        }
       return view('roles.createrole')->with(array('breadcrumb'=>$breadcrumb));
    }
    public function delete($id)
    {
        $adminrole =$this->roles->getroleById($id);
        $adminrole->delete();
        return redirect()->route('adminrole.list')
        ->with('success', 'Role has been deleted!!');
    }
    public function edit(Request $request,$id)
    {
    $breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'Admin roles' => route('adminrole.list'),
                'current_menu'=>'Edit']];
        $adminrole =$this->roles->getroleById($id);
        if ($request->method()=='POST') {

            // $request=::class;
            $requestobj=app(RoleRequest::class);
            $validatedData = $requestobj->validated();
        
        $this->roles->update($id,$validatedData);
        return redirect()->route('adminrole.list')
                        ->with('success','Role Updated successfully.');
        }
        
        return view('roles.editrole',compact('adminrole'))->with(array('adminrole'=>$adminrole,'breadcrumb'=>$breadcrumb));
    }
  
}
