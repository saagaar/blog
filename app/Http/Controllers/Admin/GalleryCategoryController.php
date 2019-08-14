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
            $categorys = $this->categories->getAll()->where('title', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $categorys = $this->categories->getAll()->paginate($this->PerPage);
        }
        
        return view('gallery.category.list')->with(array('categorys'=>$categorys,'breadcrumb'=>$breadcrumb,'menu'=>'gallery Category'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'Gallery Category' => route('gallerycategory.list'),
                    'current_menu'=>'Create Gallery Category',
                      ]];
        if ($request->method()=='POST') {

            // $request=::class;
            $requestobj=app(GallerycatRequest::class);
            $validatedData = $requestobj->validated();
            $imageName = time().'.'.request()->banner_image->getClientOriginalExtension();
            request()->banner_image->move(public_path('images/gallerycat-images'), $imageName);
            $validatedData['banner_image'] = $imageName;
        $this->categories->create($validatedData);
       return redirect()->route('gallerycategory.list')
                            ->with(array('success'=>'gallery Category created successfully.','breadcrumb'=>$breadcrumb));
        }
       return view('gallery.category.create')->with(array('breadcrumb'=>$breadcrumb));;
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
            $requestobj=app(GallerycatRequest::class);
            $validatedData = $requestobj->validated();
                if ($request->hasFile('banner_image')) {
                    $dir = 'images/gallerycat-images/';
                    if ($category->banner_image != '' && File::exists($dir . $category->banner_image))
                    File::delete($dir . $category->banner_image);

                    $imageName = time().'.'.request()->banner_image->getClientOriginalExtension();
                    request()->banner_image->move(public_path('images/gallerycat-images'), $imageName);
                    $validatedData['banner_image'] = $imageName;
                }else {
                    $validatedData['banner_image'] = $category->banner_image;
                }
            $this->categories->update($id,$validatedData);
            return redirect()->route('gallerycategory.list')
                        ->with('success','gallery category updated successfully.');
        }
        
        return view('gallery.category.edit')->with(array('category'=>$category,'breadcrumb'=>$breadcrumb));
    }


     public function delete($id)
    {
        $category =$this->categories->getByCatId($id);
        if( $category){
            $dir = 'images/gallerycat-images/';
            if ($category->image != '' && File::exists($dir . $category->image)){
                File::delete($dir . $category->image);
            }
            $category->delete();
        }
        return redirect()->route('gallerycategory.list')
        ->with('success', 'gallery category has been deleted!!');
    }
}
