<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController; 
use App\Repository\RoleInterface;

class RolesController extends AdminController
{
   protected $role;
    function __construct(RoleInterface $role)
    {
        parent::__construct();
        $this->roles=$role;
        $this->middleware('auth:admin')->except('logout');
    }
    public function list(Request $request)
    {
        $breadcrumbs=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'current_menu'=>'Account roles',
                     ]];
        $search = $request->get('search');
        if($search){
            $roles = $this->roles->getAll()
                ->where('name', 'like', '%' . $search . '%')
                ->paginate($this->PerPage)
                ->withPath('?search=' . $search);
        }else{
           $roles = $this->roles->getAll()->paginate($this->PerPage);
        }
        return view('userroles.listroles')->with(array('roles'=>$roles,'breadcrumb'=>$breadcrumbs));
    }
    public function create()
    {
        $breadcrumb=['breadcrumbs'  => [
                     'Dashboard'     => route('admin.dashboard'),
                     'Admin Roles'   => route('role.list'),
                     'current_menu'  =>'Create Account roles',
                    ]];
        if ($request->method()=='POST') 
        {
            // $request=::class;
            $requestobj=app(RoleRequest::class);
            $validatedData = $requestobj->validated();
            $this->roles->create($validatedData);
            return redirect()->route('role.list')
                        ->with('success','Roles created successfully.');
        }
       return view('userroles.createrole')->with(array('breadcrumb'=>$breadcrumb));
    }
}
