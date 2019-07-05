<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController; 
use App\Repository\BlogcategoriesInterface;  
// use App\Models\blogcategoriesegorys;
use App\Models\LogAdminActivitys;
use Illuminate\Http\Request;
use App\Http\Requests\BlogcategoryRequest;
use App;
class BlogcategoriesController extends AdminController
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
        if ($request->method()=='POST') {

            // $request=::class;
            $requestobj=app(BlogcategoryRequest::class);
            $validatedData = $requestobj->validated();
        
        $this->category->create($validatedData);
       return redirect()->route('adminblogcategory.list')
                            ->with('success','blog Category created successfully.');
        }
       return view('blog.createcategories');
    }
    public function delete($id)
    {
        $category =$this->category->getcatById($id);
        $category->delete();
        return redirect()->route('adminblogcategory.list')
        ->with('success', 'Blog category has been deleted!!');
    }
    public function edit(Request $request, $id)
    {
        $category =$this->category->getcatById($id);
        if ($request->method()=='POST') {

            // $request=::class;
            $requestobj=app(BlogcategoryRequest::class);
            $validatedData = $requestobj->validated();
        
        $this->category->update($id,$validatedData);
        return redirect()->route('adminblogcategory.list')
                        ->with('success','Blog category updated successfully.');
        }
        
        return view('blog.editcategories',compact('category'));
    }
}
