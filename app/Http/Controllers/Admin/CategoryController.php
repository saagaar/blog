<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\CategoryInterface;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
        
        return view('admin.blog.listcategories')->with(array('categorys'=>$categorys,'breadcrumb'=>$breadcrumb,'menu'=>'Blog Category'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'blog Category' => route('adminblogcategory.list'),
                    'current_menu'=>'Create Blog Category',
                      ]];
        if ($request->method()=='POST') {
            // dd($request->all());
            $requestobj=app(CategoryRequest::class);
            $this->validate($request, [
                'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1000',
                ]);
            $validatedData = $requestobj->validated();
            $imageName = time().'.'.request()->banner_image->getClientOriginalExtension();
            request()->banner_image->move(public_path('frontend/images/categories-images'), $imageName);
            $validatedData['banner_image'] = $imageName;
            $code= uniqid();
            $part1=substr($code,0, 7).str_pad($created->id,4,0,STR_PAD_BOTH);
            $part2=substr($code, 7,-1);
            $created['code']= $part1.$part2;
            $created->save();
        $this->categories->create($validatedData);
       return redirect()->route('adminblogcategory.list')
                            ->with(array('success'=>'Blog Category created successfully.','breadcrumb'=>$breadcrumb));
        }
       return view('admin.blog.createcategories')->with(array('breadcrumb'=>$breadcrumb));;
    }
    public function delete($id)
    {
        $category =$this->categories->getcatById($id);
        if( $category){
            $dir = 'frontend/images/categories-images/';
            if ($category->banner_image != '' && File::exists($dir . $category->banner_image)){
                File::delete($dir . $category->banner_image);
            }
            $category->delete();
        }
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
                $this->validate($request, [
                'banner_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1000',
                ]);
                $validatedData = $requestobj->validated();
                $this->categories->update($id,$validatedData);
                if ($request->hasFile('banner_image')) {
                    $dir = 'frontend/images/categories-images/';
                    if ($category->banner_image != '' && File::exists($dir . $category->banner_image))
                    File::delete($dir . $category->banner_image);

                    $imageName = time().'.'.request()->banner_image->getClientOriginalExtension();
                    request()->banner_image->move(public_path('frontend/images/categories-images'), $imageName);
                    $validatedData['banner_image'] = $imageName;
                }else {
                    $validatedData['banner_image'] = $category->banner_image;
                }
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
        $category = $this->categories->getcatById($request->id);
        $status = $request->status;
        $category->update(array('status'=>$status));  
       return redirect()->route('adminblogcategory.list')
                        ->with('success','Status change successfully.');
    }
}
