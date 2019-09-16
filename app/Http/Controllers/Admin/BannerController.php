<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\BannerInterface;
use Illuminate\Http\Request;
use App\Http\Requests\BannerRequest;
use Illuminate\Support\Facades\File;
use App;
class BannerController extends AdminController
{
    protected $Banner;
    function __construct(BannerInterface $banner)
    {
         parent::__construct();
         $this->Banner=$banner;
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All Banners',
                      ]];
        $search = $request->get('search');
        if($search){
            $Banner = $this->Banner->getAll()->where('title', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $Banner = $this->Banner->getAll()->paginate($this->PerPage);
        }
        return view('admin.banner.list')->with(array('Banner'=>$Banner,'breadcrumb'=>$breadcrumb,'menu'=>'Banner List'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs'=> 
                    [
                      'Dashboard'  => route('admin.dashboard'),
                      'All  Banners' => route('banner.list'),
                      'current_menu'  =>'Create Banner',
                    ]];
        if ($request->method()=='POST') 
        {
            $requestobj=app(BannerRequest::class);
            $validatedData = $requestobj->validated();
            $imageName = uniqid().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('frontend/images/banner'), $imageName);
            $validatedData['image'] = $imageName;
            $this->Banner->create($validatedData);
            return redirect()->route('banner.list')    
                             ->with(array('success'=>'Banner created successfully.','breadcrumb'=>$breadcrumb));
        }
        return view('admin.banner.create')->with(array('breadcrumb'=>$breadcrumb));
    }
    public function edit(Request $request, $id)
    {
            $breadcrumb=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'All Banners' => route('banner.list'),
                        'current_menu'=>'  Edit Banner',
                          ]];
            $banner =$this->Banner->getById($id);    
            if ($request->method()=='POST')
            {
                $requestobj=app(BannerRequest::class);
                $validatedData = $requestobj->validated();
                if($request->hasFile('image')){
                    $dir = 'frontend/images/banner/';
                if ($banner->image != '' && File::exists($dir . $banner->image)){           File::delete($dir . $banner->image);}
                    $imageName = uniqid().'.'.request()->image->getClientOriginalExtension();
                    request()->image->move(public_path('frontend/images/banner'), $imageName);
                    $validatedData['image'] = $imageName;
                }
                else 
                {
                    $validatedData['image'] = $banner->image;
                }
                $this->Banner->update($id,$validatedData);
                return redirect()->route('banner.list')
                            ->with('success','Banner Updated Successfully.');
            }
            return view('admin.banner.edit',compact('banner','breadcrumb'));
    }

    public function delete($id)
    {
       $banner =$this->Banner->getById($id);       
        if($banner){
            $dir = 'frontend/images/banner/';
            if ($banner->image != '' && File::exists($dir . $banner->image)){
                File::delete($dir . $banner->image);
            }
            $banner->delete();
        }
        return redirect()->route('banner.list')
        ->with('success', '');
    }

    /*
    * Change status of banner
    */
      public function changeStatus(Request $request)
    {
        $banner = $this->Banner->getById($request->id);
        $status = $request->status;
        $banner->update(array('status'=>$status));  
       return redirect()->route('banner.list')
                        ->with('success','Status change successfully.');
    }

    
}
