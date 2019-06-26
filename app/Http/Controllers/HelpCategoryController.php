<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController; 
use App\Repository\HelpCatInterface;  
// use App\Models\HelpCategorys;
use App\Models\LogAdminActivitys;
use Illuminate\Http\Request;

class HelpCategoryController extends AdminController
{
    protected $category;

    function __construct(HelpCatInterface $helpcat)
    {
        $this->category=$helpcat;
        
        $this->middleware('auth:admin')->except('logout');
       
    }
    public function index()
    {

        $categorys = $this->category->getAll()->paginate(5);
        return view('help.helpcat',compact('categorys','data'));
    }
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'display' => 'required',
            ]);
      
           $insert =  $this->category->create($request->all());
            $helpcategorys =$this->category->getcatById($insert->id);
            $log = new LogAdminActivitys;
            $log->log_action = "add";
            $log->log_ip = "01";
            $log->log_browser= "opera";
            $log->log_platform="windows";
            $log->log_agent = "oss";
            $log->log_referer = "http://127.0.0.1:8000/helpcategorys";
            $helpcategorys->logs()->save($log);
            return redirect()->route('helpcat')
                            ->with('success','Help Category created successfully.');
            
        }
       return view('help.createhelpcat');
    }
    public function destroy($id)
    {
        $category =$this->category->getcatById($id);
        $category->delete();
        $log = new LogAdminActivitys;
        $log->log_action = "delete";
        $log->log_ip = "01";
        $log->log_browser= "opera";
        $log->log_platform="windows";
        $log->log_agent = "oss";
        $log->log_referer = "http://127.0.0.1:8000/helpcategorys";
        $category->logs()->save($log);
        return redirect()->route('helpcat')
        ->with('success', 'category has been deleted!!');
    }
    public function edit(Request $request, $id)
    {
        $category =$this->category->getcatById($id);
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'display' => 'required',
            ]);
            $category->update($request->all());
            $logcat =$this->category->getcatById($id);
            $log = new LogAdminActivitys;
            $log->log_action = "update";
            $log->log_ip = "01";
            $log->log_browser= "opera";
            $log->log_platform="windows";
            $log->log_agent = "oss";
            $log->log_referer = "http://127.0.0.1:8000/helpcategorys";
            $logcat->logs()->save($log);
            return redirect()->route('helpcat')
                             ->with('success','Help Category updated successfully.');
        }
        return view('help.edithelpcat',compact('category','data'));
    }
}
