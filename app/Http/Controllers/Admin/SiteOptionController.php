<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\SiteoptionInterface;
use Illuminate\Http\Request;
use App\Http\Requests\SiteoptionsRequest;
use Illuminate\Support\Facades\File;
use Image;
use App;
use DB;

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
            'image' =>'image|mimes:jpeg,png,jpg,gif,svg|max:4048',
             ]);
               if ($request->hasFile('image')) 
              {     

                $uniqId= uniqid();                        
                $dir=public_path(). '/uploads/sitesettings-images';
                 if ($site->image != '' && File::exists($dir,$site->image))
                {
                  // echo "string";exit;
                File::delete($dir.$site->image);
                }
                // echo "string";exit;
                $extension = request()->image->getClientOriginalExtension();
                $imageName = $uniqId.'.'.$extension;
                $originalImg =request()->image->move($dir,$imageName);
                $img = Image::make($originalImg);
                // echo "string";exit;
                list($width, $height) = getimagesize($originalImg);  

                if ($width > 200 && $height < 200)
                {                          
                    $img->resize(200,200, function ($constraint) 
                    {
                    $constraint->aspectRatio();
                     })->save($dir.'/'.$uniqId.'.'.$extension);            
                }
                 else if($width < 200 && $height > 200)
                {
                     $img->resize(200,200, function ($constraint) 
                    {
                    $constraint->aspectRatio();
                     })->save($dir.'/'.$uniqId.'.'.$extension);
                }
                else if($width > 200 && $height > 200)
                {
                     $img->resize(200,200, function ($constraint) 
                    {
                    $constraint->aspectRatio();
                     })->save($dir.'/'.$uniqId.'.'.$extension);
                }
                else if($width < 200 && $height < 200)
                {
                     return redirect()->route('sitesetting')
                            ->with('error','image must be atleast 200x200');
                } 
                //**************resizing the image of thumbnail******************//
                
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
