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
    protected $cms;

    function __construct(CmsInterface $cms)
    {
        parent::__construct();
        $this->cms=$cms;
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
            $cms = $this->cms->getAll()
            ->where('heading', 'like', '%' . $search . '%')
            ->paginate($this->PerPage)
            ->withPath('?search=' . $search);
        }else{
            $cms = $this->cms->getAll()->paginate($this->PerPage);
        }
        return view('admin.cms.list')->with(array('cms'=>$cms,'breadcrumb'=>$breadcrumb,'menu'=>'CMS List'));

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
            $requestObj=app(CmsRequest::class);
            $validatedData = $requestObj->validated();
            $this->cms->create($validatedData);
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
            $cms =$this->cms->getCmsById($id);
            if ($request->method()=='POST') 
            {
                $requestObj=app(CmsRequest::class);
                $validatedData = $requestObj->validated();
                $this->cms->update($id,$validatedData);
                return redirect()->route('cms.list')
                            ->with('success','CMS Updated Successfully.');
            }
            return view('admin.cms.edit',compact('cms','breadcrumb'));
    }
    public function delete($id)
    {
       $cms =$this->cms->getCmsById($id);
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
        $cms = $this->cms->getCmsById($request->id);
        $status = $request->status;
        $cms->update(array('status'=>$status));  
       return redirect()->route('cms.list')
                        ->with('success','Status change successfully.');
    }

     public function changeCmsType(Request $request)
    {
        $cmstype = $this->cms->getCmsById($request->id);
        $cmstype = $request->cmstype;
        $cmstype->update(array('cms_type'=>$cmstype));  
       return redirect()->route('Cms.list')
                        ->with('success','Status change successfully.');
    }

}
