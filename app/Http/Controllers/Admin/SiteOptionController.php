<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\SiteoptionInterface;
use Illuminate\Http\Request;
use App\Http\Requests\SiteoptionsRequest;
use Illuminate\Support\Facades\File;
use App;

class SiteOptionController extends AdminController
{
    /**
    *@var $siteOptions
    * object of instance siteoption interface
    *
    */
    protected $siteOptions;

    function __construct(SiteoptionInterface $siteOptions)
    {
         parent::__construct();
         $this->siteOptions=$siteOptions;
    }
    public function edit(Request $request)
    {   

        $site =$this->siteOptions->getSiteInfo();
        $breadcrumb=array('breadcrumbs'=>array('Dashboard' => route('admin.dashboard'),
                          'current_menu' => 'Site Settings',
                          ));
        if ($request->method()=='POST') 
        {
            $requestObj=app(SiteoptionsRequest::class);
            $validatedData = $requestObj->validated();
            request()->validate([
            'image' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             ]);
               if ($request->hasFile('image')) 
               {
                 $extension = request()->image->getClientOriginalExtension();
                 $imageName = time().'.'.$extension;
                 request()->image->move(public_path('uploads/sitesettings-images'), $imageName);
                 $dir = 'uploads/sitesettings-images/';
                 if($site->image != '' && File::exists($dir . $site->image))
                    {
                    File::delete($dir . $site->image);
                    }
                   $validatedData['image'] = $imageName;        
                }  
               else
               {
                 $validatedData['image'] = $site->image;
               }
             
               $this->siteOptions->update($validatedData);
               return redirect()->route('sitesetting')
                            ->with('success','Site Settings Updated Successfully.');
        }
        return view('admin.siteoption.edit')->with(array('site'=>$site,'breadcrumb'=>$breadcrumb,'primary_menu'=>'siteoption.list'));
    }
}
