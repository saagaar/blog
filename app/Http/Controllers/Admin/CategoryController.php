<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\CategoryInterface; 
use App\Repository\TagInterface; 
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
                    'current_menu'=>'Category',
                      ]];
        $search = $request->get('search');
        if($search){
            $categories = $this->categories->getAll()->where('name', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $categories = $this->categories->getAll()->paginate($this->PerPage);
        }
        
        return view('admin.blog.listcategories')->with(array('categories'=>$categories,'breadcrumb'=>$breadcrumb,'menu'=>'Category','primary_menu'=>'gallery.list','primary_menu'=>'category.list'));
    }
    public function create(Request $request,TagInterface $tag)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'Category' => route('adminblogcategory.list'),
                    'current_menu'=>'Create Category',
                      ]];
        $tagList = $tag->getAll()->get();
        $blogcategory = $this->categories->getAll()->where('parent_id',NULL)->get();
        if ($request->method()=='POST') {
            $requestobj=app(CategoryRequest::class);
             $validatedData = $requestobj->validated();
             $this->validate($request, [
                'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1000',
                ]);
           
            $imageName = time().'.'.request()->banner_image->getClientOriginalExtension();
            request()->banner_image->move(public_path('frontend/images/categories-images/'), $imageName);
            $validatedData['banner_image'] = $imageName;
        $created = $this->categories->create($validatedData);
        $created->tags()->attach($validatedData['tags']);
        return redirect()->route('adminblogcategory.list')
                            ->with(array('success'=>'Category created successfully.','breadcrumb'=>$breadcrumb));
        }
       return view('admin.blog.createcategories')->with(array('breadcrumb'=>$breadcrumb,'tags'=>$tagList,'blogcategory'=>$blogcategory,'primary_menu'=>'category.list'));;
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
        ->with('success', 'category has been deleted!!');
    }
    public function edit(Request $request, $id,TagInterface $tag)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'Category' => route('adminblogcategory.list'),
                    'current_menu'=>'Edit Category',
                      ]];
        $tagList = $tag->getAll()->get();
        $blogcategory = $this->categories->getAll()->where('parent_id',NULL)->get();
        $category =$this->categories->getCatById($id);
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
                    request()->banner_image->move(public_path('frontend/images/categories-images/'), $imageName);
                    $validatedData['banner_image'] = $imageName;
                }else {
                    $validatedData['banner_image'] = $category->banner_image;
                }
                $updated = $this->blog->update($id,$validatedData);
                 $updated->tags()->sync($validatedData['tags']);
                return redirect()->route('adminblogcategory.list')
                            ->with('success','Category Updated Successfully.');
            }
        
        return view('admin.blog.editcategories',compact('category','breadcrumb'))->with(array('blogcategory'=>$blogcategory,'tags'=>$tagList,'primary_menu'=>'category.list'));
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
