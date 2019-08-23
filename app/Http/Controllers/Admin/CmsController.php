<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\CmsInterface; 
use Illuminate\Http\Request;
use App\Http\Requests\CmsRequest;
use Illuminate\Support\Facades\File;
use App;
class CmsController extends AdminController
{
    protected $CMS;

    function __construct(CmsInterface $cms)
    {
        parent::__construct();
        $this->CMS=$cms;
    }
    public function list(Request $request)
    {
        $breadcrumb=[
                    'breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All Cms',
                    ]];
        $search = $request->get('search');
        if($search){
            $cms = $this->CMS->getAll()
            ->where('heading', 'like', '%' . $search . '%')
            ->paginate($this->PerPage)
            ->withPath('?search=' . $search);
        }else{
            $cms = $this->CMS->getAll()->paginate($this->PerPage);
        }
        return view('admin.cms.list')->with(array('CMS'=>$cms,'breadcrumb'=>$breadcrumb,'menu'=>'CMS List'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs'=> 
                    [
                      'Dashboard'=> route('admin.dashboard'),
                      'All Cms' => route('cms.list'),
                      'current_menu'  =>'Create Cms',
                    ]];
        if ($request->method()=='POST') 
        {
            $requestobj=app(CmsRequest::class);
            $validatedData = $requestobj->validated();
            $this->CMS->create($validatedData);
            return redirect()->route('cms.list') 
                             ->with('success','CMS created successfully.');
        }
        return view('admin.cms.create')->with(array('breadcrumb'=>$breadcrumb));
    }
    public function edit(Request $request, $id)
    {
            $breadcrumb=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'All cms' => route('cms.list'),
                        'current_menu'=>'Edit Cms',
                         ]];
            $cms =$this->CMS->getcmsById($id);
            if ($request->method()=='POST') 
            {
                $requestobj=app(CmsRequest::class);
                $validatedData = $requestobj->validated();
                $this->CMS->update($id,$validatedData);
                return redirect()->route('cms.list')
                            ->with('success','CMS Updated Successfully.');
            }
            return view('admin.cms.edit',compact('cms','breadcrumb'));
    }
    public function delete($id)
    {
       $cms =$this->CMS->getcmsById($id);
       if ($cms->deletable=='N'){
           return redirect()->route('cms.list')
        ->with('error', 'cms is undeletable');
       }else{
        $cms->delete();
        return redirect()->route('cms.list')
        ->with('success', 'CMS deleted Successfully');
       }             
    }
     public function changeStatus(Request $request)
    {
        $cms = $this->CMS->getcmsById($request->id);
        $status = $request->status;
        $cms->update(array('status'=>$status));  
       return redirect()->route('cms.list')
                        ->with('success','Status change successfully.');
    }
}
