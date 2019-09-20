<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
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
            $categories = $this->categories->getAll()->where('name', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $categories = $this->categories->getAll()->paginate($this->PerPage);
        }
        
        return view('admin.blog.listcategories')->with(array('categories'=>$categories,'breadcrumb'=>$breadcrumb,'menu'=>'Blog Category'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'blog Category' => route('adminblogcategory.list'),
                    'current_menu'=>'Create Blog Category',
                      ]];
        if ($request->method()=='POST') {

            $requestObj=app(CategoryRequest::class);
            $validatedData = $requestObj->validated();
        $this->categories->create($validatedData);
       return redirect()->route('adminblogcategory.list')
                            ->with(array('success'=>'blog Category created successfully.','breadcrumb'=>$breadcrumb));
        }
       return view('admin.blog.createcategories')->with(array('breadcrumb'=>$breadcrumb));;
    }
    public function delete($id)
    {
        $category =$this->categories->getCatById($id);
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
        $category =$this->categories->getCatById($id);
        if ($request->method()=='POST') 
        {           
                $requestObj=app(CategoryRequest::class);
                $validatedData = $requestObj->validated();
                $this->categories->update($id,$validatedData);
                return redirect()->route('adminblogcategory.list')
                            ->with('success','Blog Category Updated Successfully.');
            }
        
        return view('admin.blog.editcategories',compact('category','breadcrumb'));
    }
    /*
    * Change status
    */
     public function changeStatus(Request $request)
    {
        $category = $this->categories->getCatById($request->id);
        $status = $request->status;
        $category->update(array('status'=>$status));  
       return redirect()->route('adminblogcategory.list')
                        ->with('success','Status change successfully.');
    }
}
