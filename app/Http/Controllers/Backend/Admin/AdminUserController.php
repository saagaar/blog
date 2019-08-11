<?php

namespace App\Http\Controllers\Backend\Admin;
use App\Http\Controllers\Backend\Admin\AdminController;
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
    public function list(Request $request)
    {
       $breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'Admin Users' => route('adminuser.list'),
                'current_menu'=> 'Edit User',
                  ]];

         $search = $request->get('search');
        if($search){
            $adminusers = $this->admin->getAll()
                    ->where('username', 'like', '%' . $search . '%')
                     ->orWhere('email', 'like', '%' . $search . '%')
                    ->paginate($this->PerPage)
                    ->withPath('?search=' . $search);
        }else{
            $adminusers = $this->admin->getAll()->paginate($this->PerPage);
        }         
        
        return view('admin_users.listadmin')->with(array('adminusers'=>$adminusers,'breadcrumb'=>$breadcrumb));
    }
    public function create(Request $request)
    {
      $breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'Admin Users' => route('adminuser.list'),
                'current_menu'=>'Add Users',
                  ]];
        if ($request->method()=='POST') 
        {
            $requestobj=app(AdminuserRequest::class);
            $validatedData = $requestobj->validated();
            $validatedData['password']= (Hash::make($requestobj->password));
            $this->admin->create($validatedData);
            return redirect()->route('adminuser.list')
                        ->with('success','User created successfully.');
        }
        $adminroles = $this->roles->getAll()->get();
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
        if ($request->method()=='POST') 
        {
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
