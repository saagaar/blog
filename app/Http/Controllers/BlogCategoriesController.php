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
        parent::__construct();
        $this->category=$blogcategories;
        
       
    }
    public function list()
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'Blog Category',
                      ]];
        $categorys = $this->category->getAll()->paginate($this->PerPage);
        return view('blog.listcategories')->with(array('categorys'=>$categorys,'breadcrumb'=>$breadcrumb,'menu'=>'Blog Category'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'blog Category' => route('adminblogcategory.list'),
                    'current_menu'=>'Create Blog Category',
                      ]];
        if ($request->method()=='POST') {

            // $request=::class;
            $requestobj=app(BlogcategoryRequest::class);
            $validatedData = $requestobj->validated();
        
        $this->category->create($validatedData);
       return redirect()->route('adminblogcategory.list')
                            ->with(array('success'=>'blog Category created successfully.','breadcrumb'=>$breadcrumb));
        }
       return view('blog.createcategories')->with(array('breadcrumb'=>$breadcrumb));;
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
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'blog Category' => route('adminblogcategory.list'),
                    'current_menu'=>'Edit Blog Category',
                      ]];
        $category =$this->category->getcatById($id);
        if ($request->method()=='POST') 
        {
            $requestobj=app(BlogcategoryRequest::class);
            $validatedData = $requestobj->validated();
            $this->category->update($id,$validatedData);
            return redirect()->route('adminblogcategory.list')
                        ->with('success','Blog category updated successfully.');
        }
        
        return view('blog.editcategories',compact('category'))->with(array('category'=>$category,'breadcrumb'=>$breadcrumb));
    }
}
