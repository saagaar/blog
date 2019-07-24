<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController; 
use App\Repository\BlogInterface;  
// use App\Models\blogcategoriesegorys;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App;
class BlogController extends AdminController
{
    protected $blog;

    function __construct(BlogInterface $blog)
    {
        parent::__construct();
        $this->blog=$blog;
    }
    public function list()
    {
        // $breadcrumb=['breadcrumbs' => [
        //             'Dashboard' => route('admin.dashboard'),
        //             'current_menu'=>'Blog Category',
        //               ]];
        // $categorys = $this->blog->getAll()->paginate($this->PerPage);
        // return view('blog.listcategories')->with(array('categorys'=>$categorys,'breadcrumb'=>$breadcrumb,'menu'=>'Blog Category'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'Blog Category' => route('blog.list'),
                    'current_menu'=>'Create Blog',
                      ]];
        if ($request->method()=='POST') {

            // $request=::class;
            $requestobj=app(BlogRequest::class);
            $validatedData = $requestobj->validated();
        
        $this->blog->create($validatedData);
       return redirect()->route('adminblog.list')
                            ->with(array('success'=>'Blog created successfully.','breadcrumb'=>$breadcrumb));
        }
       return view('blog.createblog')->with(array('breadcrumb'=>$breadcrumb));;
    }
    public function delete($id)
    {
        // $category =$this->blog->getcatById($id);
        // $category->delete();
        // return redirect()->route('adminblogcategory.list')
        // ->with('success', 'Blog category has been deleted!!');
    }
    public function edit(Request $request, $id)
    {
        //     $breadcrumb=['breadcrumbs' => [
        //                 'Dashboard' => route('admin.dashboard'),
        //                 'blog Category' => route('adminblogcategory.list'),
        //                 'current_menu'=>'Edit Blog Category',
        //                   ]];
        //     $category =$this->blog->getcatById($id);
        //     if ($request->method()=='POST') 
        //     {
        //         $requestobj=app(BlogcategoryRequest::class);
        //         $validatedData = $requestobj->validated();
        //         $this->blog->update($id,$validatedData);
        //         return redirect()->route('adminblogcategory.list')
        //                     ->with('success','Blog category updated successfully.');
        //     }
            
        //     return view('blog.editcategories',compact('category'))->with(array('category'=>$category,'breadcrumb'=>$breadcrumb));
    }
}
