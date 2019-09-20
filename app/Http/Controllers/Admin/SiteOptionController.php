<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\SiteoptionsInterface;
use Illuminate\Http\Request;
use App\Http\Requests\SiteoptionsRequest;
use App;
class SiteOptionController extends AdminController
{
    /**
    *@var $siteOptions
    * object of instance siteoption interface
    *
    */
    protected $siteOptions;

    function __construct(SiteoptionsInterface $siteOptions)
    {
         parent::__construct();
         $this->siteOptions=$siteOptions;
    }
    public function edit(Request $request)
    {   
        $site =$this->siteOptions->GetSiteInfo();
        $breadcrumb=array('breadcrumbs'=>array('Dashboard'     => route('admin.dashboard'),
                          'current_menu' => 'Site Settings',
                          ));
        if ($request->method()=='POST') 
        {
            $requestObj=app(SiteoptionsRequest::class);
            $validatedData = $requestObj->validated();
            $this->siteOptions->update($validatedData);
            return redirect()->route('sitesetting')
                            ->with('success','Site Settings Updated Successfully.');
        }
        return view('admin.siteoption.edit')->with(array('site'=>$site,'breadcrumb'=>$breadcrumb));
    }
}
