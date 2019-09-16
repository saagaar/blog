<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController;
use App\Repository\UserInterface;
use App\Repository\AdminRoleInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\AdminuserRequest;
use App;
class AdminUserController extends AdminController
{
    protected $admin;
    protected $adminRole;
    function __construct(UserInterface $admin,AdminRoleInterface $adminRole)
    {
        $this->admin=$admin;
        $this->roles=$adminRole;
        $this->middleware('auth:admin')->except('logout');
       
    }
    public function list(Request $request)
    {
       $breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'current_menu'=> 'All Admin Users',
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
        
        return view('admin.admin_users.listadmin')->with(array('adminusers'=>$adminusers,'breadcrumb'=>$breadcrumb));
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
        $adminRoles = $this->roles->getAll()->get();
        return view('admin.admin_users.createuser',compact('adminroles','breadcrumb'));
    }
    public function edit(Request $request,$id)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'Admin Users' => route('adminuser.list'),
                    'current_menu'=>'All Admin Users',
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
        $adminRoles = $this->roles->getAll()->get();
        return view('admin.admin_users.edituser',compact('adminroles','adminusers','breadcrumb'));
    }
    public function delete($id)
    {
        $adminRole =$this->admin->getById($id);
        $adminRole->delete();
        return redirect()->route('adminuser.list')
        ->with('success', 'User has been deleted!!');
    }

    public function password(Request $request,$id)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'Admin Users' => route('adminuser.list'),
                    'current_menu'=>'Change Password',
                      ]];
        $userid = Auth()->user()->id;//current user 
        $adminusers =$this->admin->getById($userid);
        echo $adminusers;                                                                                   
       if ($request->method()=='POST') 
        {
            $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|min:6',
            'confirm_password' =>'required_with:password|same:password|min:6'

        ]);
             $validatedData = $request->all();// all data will be here  
             if (!Hash::check($validatedData['old_password'], $adminusers->password)) {
             return back()->with('error', 'The specified password does not match the database password');
            } 
            else {
                $data['password']= (Hash::make($request->password));
                $this->admin->update($id,array('password'=>$data['password']));
                return redirect()->route('admin.logout')
                            ->with('success','Password Changed successfully.');
                }
        }
        return view('admin_password.changepassword',compact('userid','breadcrumb'));
    }
    /*
    * Change status of adminuser
    */
  public function changeStatus(Request $request)
    {
        $user = $this->admin->getById($request->id);
        $status = $request->status;
        $user->update(array('status'=>$status));  
       return redirect()->route('adminuser.list')
                        ->with('success','Status change successfully.');
    }
}
