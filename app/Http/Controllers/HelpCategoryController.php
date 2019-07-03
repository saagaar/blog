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
        
       
    }
    public function list()
    {

        $categorys = $this->category->getAll()->paginate($this->PerPage);
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
            return redirect()->route('helpcat.list')
                            ->with('success','Help Category created successfully.');
            
        }
       return view('help.createhelpcat');
    }
    public function delete($id)
    {
        $category =$this->category->getcatById($id);
        $category->delete();
        return redirect()->route('helpcat.list')
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
            return redirect()->route('helpcat.list')
                             ->with('success','Help Category updated successfully.');
        }
        return view('help.edithelpcat',compact('category','data'));
    }
}
