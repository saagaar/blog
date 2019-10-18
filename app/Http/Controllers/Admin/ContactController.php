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
            $contact = $this->contact->getAll()
            ->where('name', 'like', '%' . $search . '%')
            ->paginate($this->PerPage)
            ->withPath('?search=' . $search);
        }else{
            $contact = $this->contact->getAll()->paginate($this->PerPage);
        }
        return view('admin.contact.list')->with(array('contact'=>$contact,'breadcrumb'=>$breadcrumb,'menu'=>'contact List','primary_menu'=>'contact.list'));
    }
   
    public function edit(Request $request, $id)
    {
            $breadcrumb=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'All contact' => route('contact.list'),
                        'current_menu'=>'Edit contact',
                         ]];
            $contact =$this->contact->getContactById($id);
            if ($request->method()=='POST') 
            {
                $requestObj=app(contactRequest::class);
                $validatedData = $requestObj->validated();
                $this->contact->update($id,$validatedData);
                return redirect()->route('contact.list')
                            ->with('success','contact Updated Successfully.');
            }
            return view('admin.contact.edit',compact('contact','breadcrumb'))->with(array('primary_menu'=>'contact.list'));
    }
}
