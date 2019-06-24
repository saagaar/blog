<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController;   
use App\Models\HelpCategorys;
use App\Models\LogAdminActivitys;
use Illuminate\Http\Request;

class HelpCategoryController extends AdminController
{
    public function index()
    {
        $this->user = auth()->user();
       
        $data=$this->admin->getById($this->user->id);

        $categorys = HelpCategorys::where('display', 'Y')->get();
        // echo "<pre>";
        // print_r($categorys);exit;
        return view('help.helpcat',compact('categorys','data'));
    }
    public function create()
    {
        $this->user = auth()->user();
       
        $data=$this->admin->getById($this->user->id);

       return view('help.createhelpcat',compact('data'));
    }
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'display' => 'required',
        ]);
  
       HelpCategorys::create($request->all());
        // $helpcategorys = HelpCategorys::find(1);	
        // $log = new LogAdminActivitys;
        // $log->log_time = "2019-6-24";
        // $log->log_action = "add";
        // $log->log_ip = "01";
        // $log->log_browser= "opera";
        // $log->log_platform="windows";
        // $log->log_agent = "oss";
        // $log->log_referer = "http://127.0.0.1:8000/helpcategorys";
        // $helpcategorys->logs()->save($log);
        return redirect()->route('helpcat')
                        ->with('success','Help Category created successfully.');
        
        
    }
    public function destroy($id)
    {
        $category = HelpCategorys::find($id);
        $category->delete();

        return redirect()->route('helpcat')
        ->with('success', 'category has been deleted!!');
    }
}
