<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController; 
use App\Repository\SiteoptionsInterface;
use Illuminate\Http\Request;
use App\Http\Requests\SiteoptionsRequest;
use App;
class SiteOptionsController extends AdminController
{
    /**
    *@var $siteoptions
    * object of instance siteoption interface
    *
    */
    protected $siteoptions;
    function __construct(SiteoptionsInterface $siteoptions)
    {
        $this->site=$siteoptions;
    }
    public function edit(Request $request)
    {   
        
        $site =$this->site->GetSiteInfo();
        if ($request->method()=='POST') 
        {
            $requestobj=app(SiteoptionsRequest::class);
            $validatedData = $requestobj->validated();
        
        $this->site->update($validatedData);
        return redirect()->route('admin.dashboard')
                        ->with('success','Site setting created successfully.');
        }
        
        return view('siteoptions.siteoptions',compact('site'));
    }
}
