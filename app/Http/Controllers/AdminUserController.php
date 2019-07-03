<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController;
use App\Repository\UserInterface;
use App\Repository\AdminRoleInterface;
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
        $adminusers = $this->admin->getAll()->paginate(5);
        return view('admin_users.listadmin',compact('adminusers'));
    }
    public function create(Request $request)
    {
        if ($request->method()=='POST') {

            // $request=::class;
            $requestobj=app(AdminuserRequest::class);
            $validatedData = $requestobj->validated();
        
        $this->admin->create($validatedData);
        return redirect()->route('adminuser.list')
                        ->with('success','User created successfully.');
        }
        $adminroles = $this->roles->getAll()->get();
        // dd($adminroles);
       return view('admin_users.createuser',compact('adminroles'));
    }
    // public function store(AdminuserRequest $request)
    // {
    //     $validatedData = $request->validated();
    //     $this->admin->create($validatedData);
    //     return redirect()->route('adminusers')
    //                     ->with('success','Roles created successfully.');
        
        
    // }
    public function edit($id)
    {

        $adminroles = $this->roles->getAll()->get();
        return view('admin_users.edituser',compact('adminroles'));
    }
  
    public function update(AdminuserRequest $request,$id)
    {
        $adminusers =$this->admin->getById($id);
        $validatedData = $request->validated();

        $adminroles->update($validatedData);
        return redirect()->route('adminusers')
                         ->with('success','Role updated successfully.');
    }
}
