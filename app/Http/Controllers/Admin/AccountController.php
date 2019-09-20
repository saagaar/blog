<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController;
use App\Repository\AccountInterface;
use App\Repository\RoleInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\AccountRequest;
use Illuminate\Support\Facades\File;
use App\Models\Countries;
use App;

/** user account 

*/
class AccountController extends AdminController{
    protected $account;
    //user account
    protected $roles;
    //user roles
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
        
        return view('admin.account.list')->with(array('account'=>$account,'breadcrumb'=>$breadcrumb));
    }
    public function create(Request $request)
    {
      $breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'Users Account' => route('account.list'),
                'current_menu'=>'Add Users Account',
                  ]];
        $allRoles = $this->roles->getAll()->get();
        if ($request->method()=='POST') 
        {
            $requestObj=app(AccountRequest::class);
            $validatedData = $requestObj->validated();
            $validatedData['dob'] = date("Y-m-d", strtotime($validatedData['dob']));
            $validatedData['password']= (Hash::make($validatedData['password']));
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images/user-images'), $imageName);
            $validatedData['image'] = $imageName;
            $activeUser = $this->account->create($validatedData);            
            $roles = $request->input('roles') ? $request->input('roles') : [];
            $activeUser->assignRole($roles);  
            return redirect()->route('account.list')
                        ->with('success','account created successfully.');
        }
        $countries = Countries::All();
        return view('admin.account.create')->with(array('countries'=>$countries,'roles'=>$allRoles,'breadcrumb'=>$breadcrumb));
    }
    public function edit(Request $request,$id)// normal user list
    {
      $breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'Users Account' => route('account.list'),
                'current_menu'=>'Edit Users Account',
                  ]];
        $allRoles = $this->roles->getAll()->get();
        $accounts =$this->account->getById($id);
        if ($request->method()=='POST') 
        {
          $requestObj=app(AccountRequest::class);
          $validatedData = $requestObj->validated();
          $validatedData['dob']=date("Y-m-d", strtotime($validatedData['dob']));
          $validatedData['password']= (Hash::make($validatedData['password']));
            if ($request->hasFile('image')) 
            {
                    $dir = 'frontend/images/userimages/';
                    if ($accounts->image != '' && File::exists($dir . $accounts->image))
                    File::delete($dir . $accounts->image);

                    $imageName = time().'.'.request()->image->getClientOriginalExtension();
                    request()->image->move(public_path('frontend/images/userimages'), $imageName);
                    $validatedData['image'] = $imageName;
                }
            else 
                {
                    $validatedData['image'] = $accounts->image;
                }
            $accounts->update($validatedData);
            $roles = $request->input('roles') ? $request->input('roles') : [];
            $accounts->syncRoles($roles);  
            return redirect()->route('account.list')
                        ->with('success','account edited successfully.');
        }
        $countries = Countries::All();
        return view('admin.account.edit')->with(array('countries'=>$countries,'accounts'=>$accounts,'roles'=>$allRoles,'breadcrumb'=>$breadcrumb));
    }
    /*
    * user account detail
    */
    public function view($id) 
    { 
       $breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'All Accounts' => route('account.list'),
                'current_menu'=> 'Members Details',
                  ]];
        $accounts =$this->account->getById($id);
        
        return view('admin.account.detail')->with(array('account'=>$accounts,'breadcrumb'=>$breadcrumb));
    }
    public function delete($id)
    {
        $accounts =$this->account->getById($id);
        
        if($accounts){
            $dir = 'frontend/images/userimages/';
            if ($accounts->image != '' && File::exists($dir . $accounts->image)){
                File::delete($dir . $accounts->image);
            }
            $accounts->delete();
        }
        return redirect()->route('account.list')
        ->with('success', 'User has been deleted!!');
    }
}
