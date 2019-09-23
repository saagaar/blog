<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\GalleryInterface;  
use App\Repository\GallerycatInterface;
use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;
use Illuminate\Support\Facades\File;
use App;
class GalleryController extends AdminController
{
    protected $gallery;
    protected $category;
    function __construct(GalleryInterface $gallery,GallerycatInterface $category)
    {
        parent::__construct();
        $this->gallery=$gallery;
       $this->category=$category;
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'Gallery',
                      ]];
        $search = $request->get('search');
        if($search){
            $galleries = $this->gallery->getAll()->where('title', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $galleries = $this->gallery->getAll()->paginate($this->PerPage);
        }
        
        return view('admin.gallery.gallery.list')->with(array('galleries'=>$galleries,'breadcrumb'=>$breadcrumb,'menu'=>'gallery','primary_menu'=>'gallery.list'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'Gallery' => route('gallery.list'),
                    'current_menu'=>'Create Gallery',
                      ]];
        $category = $this->category->getAll()->get();
        if ($request->method()=='POST') {
            $requestObj=app(GalleryRequest::class);
            $validatedData = $requestObj->validated();
            $allowedFileExtension=['jpg','png','jpeg','gif','svg'];
               if ($request->file('image')) {
           		foreach ($request->image as $item){
           			$filename = $item->getClientOriginalName();
                    $extension = $item->getClientOriginalExtension();
                    $check=in_array($extension,$allowedFileExtension);
                        if($check)
                        {
           			$dir = 'images/gallery/';
                    $imageName = uniqid().'.'.$item->getClientOriginalExtension();
                    $item->move(public_path($dir), $imageName);
                    $currentDateTime = date('Y-m-d H:i:s');
                    $galleryData[] = array('title'=>$validatedData['title'],'categories_id'=>$validatedData['categories_id'],'image'=>$imageName,"created_at"=>$currentDateTime,"updated_at"=>$currentDateTime);
                    }else {
                        return redirect()->route('gallery.list')
                            ->with(array('error'=>'Sorry Only Upload png , jpg , doc','breadcrumb'=>$breadcrumb));
                    }

           		}
            }
        $this->gallery->create($galleryData);
       return redirect()->route('gallery.list')
                            ->with(array('success'=>'Gallery created successfully','breadcrumb'=>$breadcrumb));
        }
       return view('admin.gallery.gallery.create')->with(array('category'=>$category,'breadcrumb'=>$breadcrumb));;
    }
   
    public function edit(Request $request, $id)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'Gallery' => route('gallery.list'),
                    'current_menu'=>'Edit Gallery',
                      ]];
        $gallery =$this->gallery->getByImgId($id);
        $category = $this->category->getAll()->get();
        if ($request->method()=='POST') 
        {
            $requestObj=app(GalleryRequest::class);
            $validatedData = $requestObj->validated();
            $allowedFileExtension=['jpg','png','jpeg','gif','svg'];
                if ($request->hasFile('image')) 
                {
                    foreach ($request->image as $item)
                    {
                    $filename = $item->getClientOriginalName();
                    $extension = $item->getClientOriginalExtension();
                    $check=in_array($extension,$allowedFileExtension);
                    if($check)
                    {
                    $dir = 'images/gallery/';
                    if ($gallery->image != '' && File::exists($dir . $gallery->image)){
                    File::delete($dir . $gallery->image);}
                    $imageName = uniqid().'.'.request()->image->getClientOriginalExtension();
                    request()->image->move(public_path('images/gallery'), $imageName);
                    $validatedData['image'] = $imageName;
                    }

                    else{
                        return redirect()->route('gallery.list')
                            ->with(array('error'=>'Sorry Only Upload png , jpg , doc','breadcrumb'=>$breadcrumb));
                        }
                    }
                }
                else {
                    $validatedData['image'] = $gallery->image;
                     }
            $this->gallery->update($id,$validatedData);
            return redirect()->route('gallery.list')
                        ->with('success','Gallery updated successfully.');
        }
        
        return view('admin.gallery.gallery.edit')->with(array('category'=>$category,'gallery'=>$gallery,'breadcrumb'=>$breadcrumb));
    }


     public function delete($id)
    {
        $gallery =$this->gallery->getByImgId($id);
        if( $gallery){
            $dir = 'images/gallery/';
            if ($gallery->image != '' && File::exists($dir . $gallery->image)){
                File::delete($dir . $gallery->image);
            }
            $gallery->delete();
        }
        return redirect()->route('gallery.list')
        ->with('success', 'Gallery has been deleted!!');
    }
    
}
