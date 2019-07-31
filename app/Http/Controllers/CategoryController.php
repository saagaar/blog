<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController; 
use App\Repository\CategoryInterface;  
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App;
class CategoryController extends AdminController
{
    protected $categories;

    function __construct(CategoryInterface $categories)
    {
        parent::__construct();
        $this->categories=$categories;
       
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'Blog Category',
                      ]];
        $search = $request->get('search');
        if($search){
            $categorys = $this->categories->getAll()->where('name', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $categorys = $this->categories->getAll()->paginate($this->PerPage);
        }
        
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
            $requestobj=app(CategoryRequest::class);
            $validatedData = $requestobj->validated();
        $this->categories->create($validatedData);
       return redirect()->route('adminblogcategory.list')
                            ->with(array('success'=>'blog Category created successfully.','breadcrumb'=>$breadcrumb));
        }
       return view('blog.createcategories')->with(array('breadcrumb'=>$breadcrumb));;
    }
    public function delete($id)
    {
        $category =$this->categories->getcatById($id);
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
        $category =$this->categories->getcatById($id);
        if ($request->method()=='POST') 
        {
            $requestobj=app(CategoryRequest::class);
            $validatedData = $requestobj->validated();
            $this->categories->update($id,$validatedData);
            return redirect()->route('adminblogcategory.list')
                        ->with('success','Blog category updated successfully.');
        }
        
        return view('blog.editcategories',compact('category'))->with(array('category'=>$category,'breadcrumb'=>$breadcrumb));
    }
}
