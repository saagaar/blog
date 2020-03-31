<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\SeoInterface;  
use Illuminate\Http\Request;
use App\Http\Requests\SeoRequest;
use App;
class SeoController extends AdminController
{
    protected $seo;

    function __construct(SeoInterface $seo)
    {
        parent::__construct();
        $this->seo=$seo;
       
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'Seo List',
                      ]];
        $search = $request->get('search');
        if($search)
        {
            $seo = $this->seo->getAll()->where('page_slug', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }
        else{
            $seo = $this->seo->getAll()->paginate($this->PerPage);
        }
        
        return view('admin.seo.list')->with(array('seo'=>$seo,'breadcrumb'=>$breadcrumb,'menu'=>'Seo List','primary_menu'=>'seo.list'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs' => 
                    [
                        'Dashboard' => route('admin.dashboard'),
                        'Seo List' => route('seo.list'),
                        'current_menu'=>'Create Seo List',
                    ]];
        if ($request->method()=='POST') 
        {

            $requestObj=app(SeoRequest::class);
            $validatedData = $requestObj->validated();
            $this->seo->create($validatedData);
            return redirect()->route('seo.list')
                            ->with(array('success'=>'Seo List created successfully.','breadcrumb'=>$breadcrumb));
        }
       return view('admin.seo.create')->with(array('breadcrumb'=>$breadcrumb,'primary_menu'=>'seo.list'));
    }
    public function delete($id)
    {
        $seo = $this->seo->getSeoById($id);
        $seo->delete();
        return redirect()->route('seo.list')
        ->with('success', 'Seo List has been deleted!!');
    }
    public function edit(Request $request, $id)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'Seo List' => route('seo.list'),
                    'current_menu'=>'Edit Seo List',
                      ]];
        $seo =$this->seo->getSeoById($id);
        if ($request->method()=='POST') 
        {
            $requestObj=app(SeoRequest::class);
            $validatedData = $requestObj->validated();
            $this->seo->update($id,$validatedData);
            return redirect()->route('seo.list')
                        ->with('success','Seo List updated successfully.');
        }
        
        return view('admin.seo.edit',compact('seo'))->with(array('seoData'=>$seo,'breadcrumb'=>$breadcrumb,'primary_menu'=>'seo.list'));
    }
     
}
