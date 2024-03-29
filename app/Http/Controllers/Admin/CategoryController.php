<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\CategoryInterface; 
use App\Repository\TagInterface; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryRequest;
use App;
use Image;
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
        $tagList = $tag->getAllTags()->get();
        $blogcategory = $this->categories->getAll()->where('parent_id',NULL)->get();
        if ($request->method()=='POST') {

            $requestobj=app(CategoryRequest::class);
            $validatedData = $requestobj->validated();
            $validatedData['slug'] =str_slug($validatedData['slug']);

            if ($request->hasFile('banner_image')) 
              {     

                $uniqId= uniqid();                        
                $dir=public_path(). '/uploads/categories-images';
                $extension = request()->banner_image->getClientOriginalExtension();
                $imageName = $uniqId.'.'.$extension;
                $originalImg =request()->banner_image->move($dir,$imageName);
                $img = Image::make($originalImg);
                list($width, $height) = getimagesize($originalImg);  

                // if ($width > 350 && $height < 350)
                // {                          
                //     $img->resize(null,350, function ($constraint) 
                //     {
                //     $constraint->aspectRatio();
                //      })->save($dir.'/'.$uniqId.'.'.$extension);            
                // }
                //  else if($width < 350 && $height > 350)
                // {
                //      $img->resize(null,350, function ($constraint) 
                //     {
                //     $constraint->aspectRatio();
                //      })->save($dir.'/'.$uniqId.'.'.$extension);   
                // }
                // else if($width > 350 && $height > 350)
                // {
                //      $img->resize(null,350, function ($constraint) 
                //     {
                //     $constraint->aspectRatio();
                //      })->save($dir.'/'.$uniqId.'.'.$extension);   
                // }

                if($width < 500 && $height < 350)
                        {
                             return redirect()->route('adminblogcategory.list')
                                    ->with('error','image must be atleast 500x350');
                        } 
                                       
                        $img->resize(750,350, function ($constraint) 
                        {
                        $constraint->aspectRatio();
                         })->save($dir.'/'.$uniqId.'.'.$extension);            
                   
               
                //**************resizing the image of thumbnail******************//
                
                  $validatedData['banner_image'] = $imageName;
              }
            else{
                $validatedData['banner_image'] = '';
            }
        $created = $this->categories->create($validatedData);

        if($request->has('tags'))
        {
           foreach ($validatedData['tags'] as $key => $value) {
                        if(intval($value))
                        {
                            $newarraofTags[]=$value;
                        }
                        else
                        {
                            $newTags['name']=$value;
                            $id=$tag->save($newTags);
                            $newarraofTags[]=$id;
                        }
                    }
                    
                    $created->tags()->attach($newarraofTags);   
        }
        return redirect()->route('adminblogcategory.list')
                            ->with('success','Category created successfully');
        }
       return view('admin.blog.createcategories')->with(array('breadcrumb'=>$breadcrumb,'tags'=>$tagList,'blogcategory'=>$blogcategory,'primary_menu'=>'category.list'));
    }

    public function delete($id)
    {
        $category =$this->categories->getcatById($id);
        if( $category){
            $dir = 'uploads/categories-images/';
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

        $tagList = $tag->getAllTags()->get();
        // $selectedTags = $this->categories->tags();
        
        $blogcategory = $this->categories->getAll()->where('parent_id',NULL)->get();
        
        $category =$this->categories->getCatById($id);           
                // print_r($category->tags()->pluck('tags_id'));exit;
        if ($request->method()=='POST') 
        {           
                $requestobj=app(CategoryRequest::class);
                $validatedData = $requestobj->validated();
                $validatedData['slug'] =str_slug($validatedData['slug']);

               if ($request->hasFile('banner_image')) 
              {     

                $uniqId= uniqid();                        
                $dir=public_path(). '/uploads/categories-images';
                 if ($category->banner_image != '' && File::exists($dir,$category->banner_image))
                {
                  // echo "string";exit;
                    File::delete($dir.$category->banner_image);
                    }
                    // echo "string";exit;
                    $extension = request()->banner_image->getClientOriginalExtension();
                    $imageName = $uniqId.'.'.$extension;
                    $originalImg =request()->banner_image->move($dir,$imageName);
                    $img = Image::make($originalImg);
                    list($width, $height) = getimagesize($originalImg);  
                         if($width < 500 && $height < 350)
                        {
                                return redirect()->route('adminblogcategory.list')
                                    ->with('error','image must be atleast 500x350');
                        } 
                    // if ($width > 350 && $height < 350)
                    // {                          
                        $img->resize(750,500, function ($constraint) 
                        {
                        $constraint->aspectRatio();
                         })->save($dir.'/'.$uniqId.'.'.$extension);            
                    // }
                    //  else if($width < 350 && $height > 350)
                    // {
                    //      $img->resize(null,350, function ($constraint) 
                    //     {
                    //     $constraint->aspectRatio();
                    //      })->save($dir.'/'.$uniqId.'.'.$extension);   
                    // }
                    // else if($width > 350 && $height > 350)
                    // {
                    //      $img->resize(null,350, function ($constraint) 
                    //     {
                    //     $constraint->aspectRatio();
                    //      })->save($dir.'/'.$uniqId.'.'.$extension);   
                    // }
                   
                    //**************resizing the image of thumbnail******************//
                    
                    $validatedData['banner_image'] = $imageName;
                }
                else

                 {
                    $validatedData['banner_image'] = $category->banner_image;
                }
                // print_r($validatedData['tags']);exit;
                $updated = $this->categories->update($id,$validatedData);
                $newTags=array();
                $newarraofotherTags=array();
                if($request->has('tags')){
                    foreach ($validatedData['tags'] as $key => $value) {
                        if(intval($value))
                        {
                            $newarraofTags[]=$value;
                        }
                        else
                        {
                            $newTags['name']=$value;
                            $id=$tag->save($newTags);
                            $newarraofTags[]=$id;
                        }
                    }
                    
                    $category->tags()->sync($newarraofTags);            
                }
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
    public function changeVisibility(Request $request)
    {
        $category = $this->categories->getCatById($request->id);
        $showInHome = $request->show_in_home;
        $category->update(array('show_in_home'=>$showInHome));  
       return redirect()->route('adminblogcategory.list')
                        ->with('success','Status change successfully.');
    }
}
