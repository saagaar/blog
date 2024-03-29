<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\GallerycatInterface;  
use Illuminate\Http\Request;
use App\Http\Requests\GallerycatRequest;
use Illuminate\Support\Facades\File;
use App;
class GalleryCategoryController extends AdminController
{
    protected $categories;
    
    function __construct(GallerycatInterface $categories)
    {
        parent::__construct();
        $this->categories=$categories;
       
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'Gallery Category',
                      ]];
        $search = $request->get('search');
        if($search){
            $categories= $this->categories->getAll()->where('title', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $categories = $this->categories->getAll()->paginate($this->PerPage);
        }
        
        return view('admin.gallery.category.list')->with(array('categories'=>$categories,'breadcrumb'=>$breadcrumb,'menu'=>'gallery Category','primary_menu'=>'gallerycat.list'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'Gallery Category' => route('gallerycategory.list'),
                    'current_menu'=>'Create Gallery Category',
                      ]];
        if ($request->method()=='POST') 
        {

            $requestobj=app(GallerycatRequest::class);
            $validatedData = $requestobj->validated();
            $imageName = time().'.'.request()->banner_image->getClientOriginalExtension();
            request()->banner_image->move(public_path('uploads/gallery-cat-images'), $imageName);
            $validatedData['banner_image'] = $imageName;
            $this->categories->create($validatedData);
            return redirect()->route('gallerycategory.list')
                            ->with(array('success'=>'gallery Category created successfully.','breadcrumb'=>$breadcrumb));
        }
       return view('admin.gallery.category.create')->with(array('breadcrumb'=>$breadcrumb,'primary_menu'=>'gallerycat.list'));;
    }
   
    public function edit(Request $request, $id)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'Gallery Category' => route('gallerycategory.list'),
                    'current_menu'=>'Edit Gallery Category',
                      ]];
        $category =$this->categories->getByCatId($id);
        if ($request->method()=='POST') 
        {
            $requestObj=app(GallerycatRequest::class);
            $validatedData = $requestObj->validated();
                if ($request->hasFile('banner_image')){
                    $dir = 'uploads/gallery-cat-images/';
                    if ($category->banner_image != '' && File::exists($dir . $category->banner_image))
                    $imageName = time().'.'.request()->banner_image->getClientOriginalExtension();
                    request()->banner_image->move(public_path('uploads/gallery-cat-images'), $imageName);
                    $validatedData['banner_image'] = $imageName;

                }
                else {
                    $validatedData['banner_image'] = $category->banner_image;
                }
            $this->categories->update($id,$validatedData);
            return redirect()->route('gallerycategory.list')
                        ->with('success','gallery category updated successfully.');
        }
        
        return view('admin.gallery.category.edit')->with(array('category'=>$category,'breadcrumb'=>$breadcrumb,'primary_menu'=>'gallerycat.list'));
    }


     public function delete($id)
    {
        $category =$this->categories->getByCatId($id);
        if( $category){
            $dir = 'uploads/gallerycat-images/';
            if ($category->image != '' && File::exists($dir . $category->image)){
                File::delete($dir . $category->image);
            }
            $category->delete();
        }
        return redirect()->route('gallerycategory.list')
        ->with('success', 'gallery category has been deleted!!');
    }
    public function view($id)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'Gallery Category' => route('gallerycategory.list'),
                    'current_menu'=>'View gallery Images',
                      ]];
        $category =$this->categories->getByCatId($id);
        $gallery = $category->galleries()->get();
        return view('admin.gallery.category.viewgallery')->with(array('category'=>$category,'gallery'=>$gallery,'breadcrumb'=>$breadcrumb,'primary_menu'=>'gallerycat.list'));
    }

     public function changeStatus(Request $request)
    {
        $categories = $this->categories->getByCatId($request->id);
        $status =$request->status;
        $categories->update(array('status'=>$status)); 
        return redirect()->route('categories.list')
                        ->with('success','Status change successfully.');
    } 
}
