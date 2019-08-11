<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Repository\PermissionInterface;
use App\Http\Requests\PermissionsRequest;
use App;
class PermissionsController extends AdminController{
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
                'User Permission' => route('permission.list'),
                'current_menu'=> 'All User Permission',
                  ]];

         $search = $request->get('search');
        if($search){
            $permission = $this->permission->getAll()
                    ->where('name', 'like', '%' . $search . '%')
                    ->paginate($this->PerPage)
                    ->withPath('?search=' . $search);
        }else{
            $permission = $this->permission->getAll()->paginate($this->PerPage);
        }         
        
        return view('userpermissions.listpermission')->with(array('permissions'=>$permission,'breadcrumb'=>$breadcrumb));
    }
     public function create(Request $request)
    {
      $breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'Users permission' => route('permission.list'),
                'current_menu'=>'Add Users permission',
                  ]];
        if ($request->method()=='POST') 
        {
            $requestobj=app(PermissionsRequest::class);
            $validatedData = $requestobj->validated();
            // dd($validatedData);
            $this->permission->create($validatedData);
            return redirect()->route('permission.list')
                        ->with('success','permission created successfully.');
        }
        // $adminroles = $this->roles->getAll()->get();
        return view('userpermissions.addpermission',compact('breadcrumb'));
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
   
            $requestobj=app(PermissionsRequest::class);
            $validatedData = $requestobj->validated();
           $this->permission->update($id,$validatedData);
            return redirect()->route('permission.list')
                        ->with('success','Permission edited successfully.');
        }
        // $adminroles = $this->roles->getAll()->get();
        return view('userpermissions.editpermission',compact('breadcrumb','permissions'));
    }
    public function delete($id)
    {
        $permissions =$this->permission->getById($id);
        $permissions->delete();
        return redirect()->route('permission.list')
        ->with('success', 'Permission has been deleted!!');
    }
}
