<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\Admin\AdminController; 
use App\Repository\AdminRoleInterface;
use App\Repository\ModuleRolePermissionInterface;
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
    public function list(Request $request)
    {
        $breadcrumbs=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'current_menu'=>'Admin roles',
                     ]];
        $search = $request->get('search');
        if($search){
            $adminroles = $this->roles->getAll()
                ->where('role_name', 'like', '%' . $search . '%')
                ->paginate($this->PerPage)
                ->withPath('?search=' . $search);
        }else{
           $adminroles = $this->roles->getAll()->paginate($this->PerPage);
        }
        return view('roles.adminrole')->with(array('adminroles'=>$adminroles,'breadcrumb'=>$breadcrumbs));
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
        $breadcrumb=[
                        'breadcrumbs'   => [
                        'Dashboard'     =>  route('admin.dashboard'),
                        'Admin roles'   =>  route('adminrole.list'),
                        'current_menu'  =>  'Edit'
                                           ]
                    ];
        $adminrole =$this->roles->getroleById($id);
        if ($request->method()=='POST') 
        {
            $requestobj=app(RoleRequest::class);
            $validatedData = $requestobj->validated();
            $this->roles->update($id,$validatedData);
            return redirect()->route('adminrole.list')
                            ->with('success','Role Updated successfully.');
        }
        return view('roles.editrole',compact('adminrole'))->with(array('adminrole'=>$adminrole,'breadcrumb'=>$breadcrumb));
    }

    
}
