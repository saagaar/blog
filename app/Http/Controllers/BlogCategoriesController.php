<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController; 
use App\Repository\BlogcategoriesInterface;  
// use App\Models\blogcategoriesegorys;
use App\Models\LogAdminActivitys;
use Illuminate\Http\Request;

class blogcategoriesegoryController extends AdminController
{
    protected $category;

    function __construct(BlogcategoriesInterface $blogcategories)
    {
        $this->category=$blogcategories;
        
       
    }
    public function list()
    {

        $categorys = $this->category->getAll()->paginate($this->PerPage);
        return view('blog.listcategories',compact('categorys'));
    }
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'display' => 'required',
            ]);
      
           $insert =  $this->category->create($request->all());
            return redirect()->route('blogcategories.list')
                            ->with('success','Help Category created successfully.');
            
        }
       return view('help.createblogcategories');
    }
    public function delete($id)
    {
        $category =$this->category->getcatById($id);
        $category->delete();
        return redirect()->route('blogcategories.list')
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
            return redirect()->route('blogcategories.list')
                             ->with('success','Help Category updated successfully.');
        }
        return view('help.editblogcategories',compact('category','data'));
    }
}
