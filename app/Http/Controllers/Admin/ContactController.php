<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\ContactInterface; 
use Illuminate\Http\Request;
use App\Http\Requests\contactRequest;
use App;
class ContactController extends AdminController
{
    protected $contact;

    function __construct(ContactInterface $contact)
    {
        parent::__construct();
        $this->contact=$contact;
    }
    public function list(Request $request)
    {
        $breadcrumb=[
                    'breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All contact',
                    ]];
        $search = $request->get('search');
        if($search){
            $contact = $this->contact->GetAll()
            ->where('name', 'like', '%' . $search . '%')
            ->paginate($this->PerPage)
            ->withPath('?search=' . $search);
        }else{
            $contact = $this->contact->GetAll()->paginate($this->PerPage);
        }
        return view('contact.list')->with(array('contact'=>$contact,'breadcrumb'=>$breadcrumb,'menu'=>'contact List'));
    }
    // public function create(Request $request)
    // {
    //     $breadcrumb=['breadcrumbs'    => 
    //                 [
    //                   'Dashboard'     => route('admin.dashboard'),
    //                   'All contact' => route('contact.list'),
    //                   'current_menu'  =>'Create contact',
    //                 ]];

    //     if ($request->method()=='POST') 
    //     {
    //         $requestobj=app(contactRequest::class); 
    //         $validatedData = $requestobj->validated();
    //         $this->contact->create($validatedData);

    //         return redirect()->route('contact.list') 
    //                          ->with(array('success'=>'contact created successfully.','breadcrumb'=>$breadcrumb));
    //     }
    //     return view('contact.createcontact')->with(array('breadcrumb'=>$breadcrumb));
    // }
    public function edit(Request $request, $id)
    {
            $breadcrumb=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'All contact' => route('contact.list'),
                        'current_menu'=>'Edit contact',
                         ]];
            $contact =$this->contact->getcontactById($id);
            if ($request->method()=='POST') 
            {
                $requestobj=app(contactRequest::class);
                $validatedData = $requestobj->validated();
                // dd($validatedData);
                $this->contact->update($id,$validatedData);
                return redirect()->route('contact.list')
                            ->with('success','contact Updated Successfully.');
            }
            // dd($contact);
            return view('contact.edit',compact('contact','breadcrumb'));
    }
}
