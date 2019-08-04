<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController;
use App\Repository\AccountInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\AccountRequest;
use App;
class AccountController extends AdminController{
    protected $account;
    // protected $adminrole;
    function __construct(AccountInterface $account)//,AdminRoleInterface $adminrole)
    {
        $this->account=$account;
        // $this->roles=$adminrole;
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
        if ($request->method()=='POST') 
        {
            $requestobj=app(AccountRequest::class);
            $validatedData = $requestobj->validated();
            $validatedData['password']= (Hash::make($requestobj->password));
            $this->account->create($validatedData);
            return redirect()->route('account.list')
                        ->with('success','account created successfully.');
        }
        // $adminroles = $this->roles->getAll()->get();
        return view('account.createuser',compact('breadcrumb'));
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
            $validatedData['password']= (Hash::make($requestobj->password));
           $this->account->update($id,$validatedData);
            return redirect()->route('account.list')
                        ->with('success','account edited successfully.');
        }
        // $adminroles = $this->roles->getAll()->get();
        return view('account.edituser',compact('breadcrumb','accounts'));
    }
}
