<?php

namespace App\Http\Controllers\Backend\Admin;
use App\Http\Controllers\Backend\Admin\AdminController; 
use App\Repository\SiteoptionsInterface;
use Illuminate\Http\Request;
use App\Http\Requests\SiteoptionsRequest;
use App;
class SiteOptionController extends AdminController
{
    /**
    *@var $siteoptions
    * object of instance siteoption interface
    *
    */
    protected $siteoptions;

    function __construct(SiteoptionsInterface $siteoptions)
    {
         parent::__construct();
         $this->site=$siteoptions;
    }
    public function edit(Request $request)
    {   
        $site =$this->site->GetSiteInfo();
        $breadcrumb=array('breadcrumbs'=>array('Dashboard'     => route('admin.dashboard'),
                          'current_menu' => 'Site Settings',
                          ));
        if ($request->method()=='POST') 
        {
            $requestobj=app(SiteoptionsRequest::class);
            $validatedData = $requestobj->validated();
            $this->site->update($validatedData);
            return redirect()->route('sitesetting')
                            ->with('success','Site Settings Updated Successfully.');
        }
        return view('siteoptions.siteoptions')->with(array('site'=>$site,'breadcrumb'=>$breadcrumb));
    }
}
