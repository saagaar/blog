<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\LanguageInterface;
use Illuminate\Http\Request;
use App\Http\Requests\LanguageRequest;
use Illuminate\Support\Facades\File;
use App;
class LanguageController extends AdminController
{
    protected $language;
    function __construct(LanguageInterface $language)
    {
         parent::__construct();
         $this->language=$language;
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All Languages',
                      ]];
        $search = $request->get('search');
        if($search){
            $language = $this->language->getAll()->where('language', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $language = $this->language->getAll()->paginate($this->PerPage);
        }
        return view('language.list')->with(array('Language'=>$language,'breadcrumb'=>$breadcrumb,'menu'=>'Language List'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs'=> 
                    [
                      'Dashboard'  => route('admin.dashboard'),
                      'All Languages' => route('language.list'),
                      'current_menu'  =>'Create Language',
                    ]];
        if ($request->method()=='POST') 
        {
            $requestobj=app(LanguageRequest::class);
            $validatedData = $requestobj->validated();
            $this->language->create($validatedData);
            return redirect()->route('language.list')    
                             ->with(array('success'=>'Language created successfully.','breadcrumb'=>$breadcrumb));
        }
        return view('language.create')->with(array('breadcrumb'=>$breadcrumb));
    }
   public function edit(Request $request, $id)
    {
            $breadcrumb=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'All languages' => route('language.list'),
                        'current_menu'=>'Edit languages',
                          ]];
            $language =$this->language->getById($id);    
            if ($request->method()=='POST')
            {
                $requestobj=app(LanguageRequest::class);
                $validatedData = $requestobj->validated();
                $this->language->update($id,$validatedData);
                return redirect()->route('language.list')
                            ->with('success','Languages Updated Successfully.');
            }
            return view('language.edit',compact('language','breadcrumb'));
    }
    public function delete($id)
    {
       $language =$this->language->getById($id);       
        $language->delete();        
        return redirect()->route('language.list')
        ->with('success', 'Language deleted Successfully');
    }

       public function changeStatus(Request $request)
    {
        $language = $this->language->getById($request->id);
        $status = $request->status;
        $language->update(array('status'=>$status));  
        return redirect()->route('language.list')
                        ->with('success','Status change successfully.');
    }


}
