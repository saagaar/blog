<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController;
use App\Repository\UserInterface;
use App\Repository\AdminRoleInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\AdminuserRequest;
use App;
class AdminUserController extends AdminController
{
    protected $admin;
    protected $adminrole;
    function __construct(UserInterface $admin,AdminRoleInterface $adminrole)
    {
        $this->admin=$admin;
        $this->roles=$adminrole;
        $this->middleware('auth:admin')->except('logout');
       
    }
    public function list()
    {
       $breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'Admin Users' => route('adminuser.list'),
                'current_menu'=> 'Edit User',
                  ]];
        $adminusers = $this->admin->getAll()->paginate($this->PerPage);
        return view('admin_users.listadmin')->with(array('adminusers'=>$adminusers,'breadcrumb'=>$breadcrumb));
    }
    public function create(Request $request)
    {
      $breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'Admin Users' => route('adminuser.list'),
                'current_menu'=>'Add Users',
                  ]];
        if ($request->method()=='POST') {

            // $request=::class;
            $requestobj=app(AdminuserRequest::class);
            $validatedData = $requestobj->validated();
       $validatedData['password']= (Hash::make($requestobj->password));
        $this->admin->create($validatedData);
        return redirect()->route('adminuser.list')
                        ->with('success','User created successfully.');
        }
        $adminroles = $this->roles->getAll()->get();
        // dd($adminroles);
       return view('admin_users.createuser',compact('adminroles','breadcrumb'));
    }
    public function edit(Request $request,$id)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'Admin Users' => route('adminuser.list'),
                    'current_menu'=>'Edit Users',
                      ]];
        $adminusers =$this->admin->getById($id);
        if ($request->method()=='POST') {

            // $request=::class;
            $requestobj=app(AdminuserRequest::class);
            
            $validatedData = $requestobj->validated();
         $validatedData['password']= (Hash::make($requestobj->password));
        $this->admin->update($id,$validatedData);
        return redirect()->route('adminuser.list')
                        ->with('success','User updated successfully.');
        }
        $adminroles = $this->roles->getAll()->get();
        return view('admin_users.edituser',compact('adminroles','adminusers','breadcrumb'));
    }
    public function delete($id)
    {
        $adminrole =$this->admin->getById($id);
        $adminrole->delete();
        return redirect()->route('adminuser.list')
        ->with('success', 'User has been deleted!!');
    }
  
}
