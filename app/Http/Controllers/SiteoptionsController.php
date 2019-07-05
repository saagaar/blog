<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController; 
use App\Repository\SiteoptionsInterface;
use Illuminate\Http\Request;
use App\Http\Requests\SiteoptionsRequest;
use App;
class SiteoptionsController extends Controller
{
    protected $siteoptions;
    function __construct(SiteoptionsInterface $siteoptions)
    {
        $this->site=$siteoptions;
        $this->middleware('auth:admin')->except('logout');
    }
    public function edit(Request $request)
    {   
        $id = 1;
        $site =$this->site->getsiteinfoById($id);
        if ($request->method()=='POST') {

            // $request=::class;
            $requestobj=app(SiteoptionsRequest::class);
            $validatedData = $requestobj->validated();
        
        $this->site->update($id,$validatedData);
        return redirect()->route('admin.dashboard')
                        ->with('success','site setting created successfully.');
        }
        
        return view('siteoptions.siteoptions',compact('site'));
    }
}
