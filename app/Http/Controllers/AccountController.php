<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController;
use App\Repository\AccountInterface;
use App\Repository\RoleInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\AccountRequest;
use App\Models\Countrys;
use App;
class AccountController extends AdminController{
    protected $account;
    protected $roles;
    function __construct(AccountInterface $account,RoleInterface $roles)
    {
        $this->account=$account;
        $this->roles=$roles;
        $this->middleware('auth:admin')->except('logout');
       
    }
    public function list(Request $request)
    {
       $breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'Account' => route('account.list'),
                'current_menu'=> 'All User Account',
                  ]];

         $search = $request->get('search');
        if($search){
            $account = $this->account->getAll()
                    ->where('name', 'like', '%' . $search . '%')
                     ->orWhere('email', 'like', '%' . $search . '%')
                    ->paginate($this->PerPage)
                    ->withPath('?search=' . $search);
        }else{
            $account = $this->account->getAll()->paginate($this->PerPage);
        }         
        
        return view('account.listaccount')->with(array('account'=>$account,'breadcrumb'=>$breadcrumb));
    }
    public function create(Request $request)
    {
      $breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'Users Account' => route('account.list'),
                'current_menu'=>'Add Users Account',
                  ]];
        $roles = $this->roles->getAll()->get();
        if ($request->method()=='POST') 
        {
            $requestobj=app(AccountRequest::class);
            $validatedData = $requestobj->validated();
            $validatedData['dob'] = date("Y-m-d", strtotime($requestobj->dob));
            $validatedData['password']= (Hash::make($requestobj->password));
            $user = $this->account->create($validatedData);
            
            $rr = $request->input('roles') ? $request->input('roles') : [];
            $user->assignRole($rr);  
            return redirect()->route('account.list')
                        ->with('success','account created successfully.');
        }
        $countries = Countrys::All();
        // $adminroles = $this->roles->getAll()->get();
        return view('account.createuser')->with(array('countries'=>$countries,'roles'=>$roles,'breadcrumb'=>$breadcrumb));
    }
    public function edit(Request $request,$id)
    {
      $breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'Users Account' => route('account.list'),
                'current_menu'=>'Edit Users Account',
                  ]];
        $accounts =$this->account->getById($id);
        if ($request->method()=='POST') 
        {
            $requestobj=app(AccountRequest::class);
            $validatedData = $requestobj->validated();
            $validatedData['dob'] = date("Y-m-d", strtotime($requestobj->dob));
            $validatedData['password']= (Hash::make($requestobj->password));
           $this->account->update($id,$validatedData);
            return redirect()->route('account.list')
                        ->with('success','account edited successfully.');
        }
        // $adminroles = $this->roles->getAll()->get();
        return view('account.edituser',compact('breadcrumb','accounts'));
    }
    public function delete($id)
    {
        $accounts =$this->account->getById($id);
        $accounts->delete();
        return redirect()->route('account.list')
        ->with('success', 'User has been deleted!!');
    }
}
