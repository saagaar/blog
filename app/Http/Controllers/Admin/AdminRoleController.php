<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\AdminRoleInterface;
use App\Repository\AdminRolePermissionInterface;
use App\Http\Requests\RoleRequest;
use App;
class AdminRoleController extends AdminController
{
    protected $adminRole;
    function __construct(AdminRoleInterface $adminRole)
    {
        parent::__construct();
        $this->roles=$adminRole;
        $this->middleware('auth:admin')->except('logout');
    }
    public function list(Request $request)
    {
        $breadcrumbs=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'current_menu'=>'Admin roles',
                     ]];
        $search = $request->get('search');
        if($search){
            $adminRoles = $this->roles->getAll()
                ->where('role_name', 'like', '%' . $search . '%')
                ->paginate($this->PerPage)
                ->withPath('?search=' . $search);
        }else{
           $adminRoles = $this->roles->getAll()->paginate($this->PerPage);
        }
        return view('admin.adminrole.list')->with(array('adminRoles'=>$adminRoles,'breadcrumb'=>$breadcrumbs,'primary_menu'=>'role.list'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs'  => [
                     'Dashboard'     => route('admin.dashboard'),
                     'Admin Roles'   => route('adminrole.list'),
                     'current_menu'  =>'Create',
                    ]];
        if ($request->method()=='POST') 
        {
            $requestObj=app(RoleRequest::class);
            $validatedData = $requestObj->validated();
            $this->roles->create($validatedData);
            return redirect()->route('adminrole.list')
                        ->with('success','Roles created successfully.');
        }
       return view('admin.adminrole.create')->with(array('breadcrumb'=>$breadcrumb,'primary_menu'=>'role.list'));
    }
    public function delete($id)
    {
        $adminRole =$this->roles->getRoleById($id);
        $adminRole->delete();
        return redirect()->route('adminrole.list')
        ->with('success', 'Role has been deleted!!');
    }
    public function edit(Request $request,$id)
    {
        $breadcrumb=[
                        'breadcrumbs'   => [
                        'Dashboard'     =>  route('admin.dashboard'),
                        'Admin roles'   =>  route('adminrole.list'),
                        'current_menu'  =>  'Edit'
                                           ]
                    ];
        $adminRole =$this->roles->getRoleById($id);
        if ($request->method()=='POST') 
        {
            $requestObj=app(RoleRequest::class);
            $validatedData = $requestObj->validated();
            $this->roles->update($id,$validatedData);
            return redirect()->route('adminrole.list')
                            ->with('success','Role Updated successfully.');
        }
        return view('admin.adminrole.edit',compact('adminRole'))->with(array('adminRole'=>$adminRole,'breadcrumb'=>$breadcrumb,'primary_menu'=>'role.list'));
    }
    /*
    * Change status of admin role
    */
    public function changeStatus(Request $request)
    {
        $role = $this->roles->getRoleById($request->id);
        $status = $request->status;
        $role->update(array('status'=>$status));  
        return redirect()->route('adminrole.list')
                        ->with('success','Status change successfully.');
    }

    
}
