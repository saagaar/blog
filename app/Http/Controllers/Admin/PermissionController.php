<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Repository\PermissionInterface;
use App\Http\Requests\PermissionsRequest;
use App;
class PermissionController extends AdminController{
    protected $permission;
    // protected $adminrole;
    function __construct(PermissionInterface $permission)//,AdminRoleInterface $adminrole)
    {
        $this->permission=$permission;
        // $this->roles=$adminrole;
        $this->middleware('auth:admin')->except('logout');
       
    }
    public function list(Request $request)
    {
       $breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'User Permissions' => route('permission.list'),
                'current_menu'=> 'All User Permissions',
                  ]];

         $search = $request->get('search');
         if($search){
            $permission = $this->permission->getAll()
                    ->where('name', 'like', '%' . $search . '%')
                    ->paginate($this->PerPage)
                    ->withPath('?search=' . $search);
        }
        else
        {
            $permission = $this->permission->getAll()->paginate($this->PerPage);
        }         
        
        return view('admin.userpermission.list')->with(array('permissions'=>$permission,'breadcrumb'=>$breadcrumb));
    }
     public function create(Request $request)
    {
      $breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'Users permission' => route('permission.list'),
                'current_menu'=>'Add Users Permission',
                  ]];
        if ($request->method()=='POST') 
        {
            $requestObj=app(PermissionsRequest::class);
            $validatedData = $requestObj->validated();
            $this->permission->create($validatedData);
            return redirect()->route('permission.list')
                        ->with('success','Permission created successfully.');
        }
        return view('admin.userpermission.create',compact('breadcrumb'));
    }
    public function edit(Request $request,$id)
    {
      $breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'Users permission' => route('permission.list'),
                'current_menu'=>'Edit Users permission',
                  ]];
        $permissions =$this->permission->getById($id);
        if ($request->method()=='POST') 
        {
   
            $requestObj=app(PermissionsRequest::class);
            $validatedData = $requestObj->validated();
           $this->permission->update($id,$validatedData);
            return redirect()->route('permission.list')
                        ->with('success','Permission edited successfully.');
        }
        return view('admin.userpermission.edit',compact('breadcrumb','permissions'));
    }
    public function delete($id)
    {
        $permissions =$this->permission->getById($id);
        $permissions->delete();
        return redirect()->route('permission.list')
        ->with('success', 'Permission has been deleted!!');
    }
}
