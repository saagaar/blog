<?php

namespace App\Http\Controllers\Backend\Admin;
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Repository\AccountInterface;
use App\Repository\RoleInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\AccountRequest;
use Illuminate\Support\Facades\File;
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
        $allroles = $this->roles->getAll()->get();
        if ($request->method()=='POST') 
        {
            $requestobj=app(AccountRequest::class);
            $validatedData = $requestobj->validated();
            $validatedData['dob'] = date("Y-m-d", strtotime($requestobj->dob));
            $validatedData['password']= (Hash::make($requestobj->password));
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            // dd($imageName);
            request()->image->move(public_path('images/userimages'), $imageName);
            $validatedData['image'] = $imageName;
            $user = $this->account->create($validatedData);
            
            $roles = $request->input('roles') ? $request->input('roles') : [];
            // dd($roles);
            $user->assignRole($roles);  
            return redirect()->route('account.list')
                        ->with('success','account created successfully.');
        }
        $countries = Countrys::All();
        // $adminroles = $this->roles->getAll()->get();
        return view('account.createuser')->with(array('countries'=>$countries,'roles'=>$allroles,'breadcrumb'=>$breadcrumb));
    }
    public function edit(Request $request,$id)
    {
      $breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'Users Account' => route('account.list'),
                'current_menu'=>'Edit Users Account',
                  ]];
                  $allroles = $this->roles->getAll()->get();
        $accounts =$this->account->getById($id);
        if ($request->method()=='POST') 
        {
            $requestobj=app(AccountRequest::class);
            $validatedData = $requestobj->validated();
            $validatedData['dob'] = date("Y-m-d", strtotime($requestobj->dob));
            $validatedData['password']= (Hash::make($requestobj->password));
            if ($request->hasFile('image')) {
                    $dir = 'images/userimages/';
                    if ($accounts->image != '' && File::exists($dir . $accounts->image))
                    File::delete($dir . $accounts->image);

                    $imageName = time().'.'.request()->image->getClientOriginalExtension();
                    request()->image->move(public_path('images/userimages'), $imageName);
                    $validatedData['image'] = $imageName;
                }else {
                    $validatedData['image'] = $accounts->image;
                }
            $accounts->update($validatedData);
            $roles = $request->input('roles') ? $request->input('roles') : [];
            // dd($roles);
            $accounts->syncRoles($roles);  
            return redirect()->route('account.list')
                        ->with('success','account edited successfully.');
        }
        $countries = Countrys::All();
        // $adminroles = $this->roles->getAll()->get();
        return view('account.edituser')->with(array('countries'=>$countries,'accounts'=>$accounts,'roles'=>$allroles,'breadcrumb'=>$breadcrumb));
    }
    public function View($id)
    {
       $breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'All Accounts' => route('account.list'),
                'current_menu'=> 'Members Details',
                  ]];

        $accounts =$this->account->getById($id);
        
        return view('account.detail')->with(array('account'=>$accounts,'breadcrumb'=>$breadcrumb));
    }
    public function delete($id)
    {
        $accounts =$this->account->getById($id);
        $results = $accounts->delete();
        if($result=='true'){
            $dir = 'images/userimages/';
            if ($accounts->image != '' && File::exists($dir . $accounts->image)){
                File::delete($dir . $accounts->image);
            }
        }
        return redirect()->route('account.list')
        ->with('success', 'User has been deleted!!');
    }
}
