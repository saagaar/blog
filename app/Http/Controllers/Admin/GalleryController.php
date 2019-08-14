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
                    'current_menu'=>'Gallery Category',
                      ]];
        $search = $request->get('search');
        if($search){
            $gallerys = $this->gallery->getAll()->where('title', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $gallerys = $this->gallery->getAll()->paginate($this->PerPage);
        }
        
        return view('gallery.gallery.list')->with(array('gallerys'=>$gallerys,'breadcrumb'=>$breadcrumb,'menu'=>'gallery'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'Gallery' => route('gallery.list'),
                    'current_menu'=>'Create Gallery',
                      ]];
        $category = $this->category->GetAll()->get();
        if ($request->method()=='POST') {
            $requestobj=app(GalleryRequest::class);
            $validatedData = $requestobj->validated();
            // dd($validatedData);
           if ($images = $request->file('image')) {
           		foreach ($images as $item) {
           			// dd($item);
           			$dir = 'images/gallery-images/';
                    $imageName = time().'.'.$item->getClientOriginalExtension();
                    $item->move(public_path($dir), $imageName);
                    $data[] = $imageName;
                    $validatedData['image'][] = $data;
                    // dd($validatedData);
           		}
            }
            // dd($data);
        $this->gallery->create($validatedData);
       return redirect()->route('gallery.list')
                            ->with(array('success'=>'Gallery created successfully','breadcrumb'=>$breadcrumb));
        }
       return view('gallery.gallery.create')->with(array('category'=>$category,'breadcrumb'=>$breadcrumb));;
    }
   
    public function edit(Request $request, $id)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'Gallery' => route('gallery.list'),
                    'current_menu'=>'Edit Gallery',
                      ]];
        $gallery =$this->gallery->getByImgId($id);
        if ($request->method()=='POST') 
        {
            $requestobj=app(GalleryRequest::class);
            $validatedData = $requestobj->validated();
                if ($request->hasFile('image')) {
                    $dir = 'images/gallery-images/';
                    if ($gallery->image != '' && File::exists($dir . $gallery->image))
                    File::delete($dir . $gallery->image);

                    $imageName = time().'.'.request()->image->getClientOriginalExtension();
                    request()->image->move(public_path('images/gallery-images'), $imageName);
                    $validatedData['image'] = $imageName;
                }else {
                    $validatedData['image'] = $gallery->image;
                }
            $this->gallery->update($id,$validatedData);
            return redirect()->route('gallery.list')
                        ->with('success','Gallery updated successfully.');
        }
        
        return view('gallery.gallery.edit')->with(array('gallery'=>$gallery,'breadcrumb'=>$breadcrumb));
    }


     public function delete($id)
    {
        $gallery =$this->gallery->getByImgId($id);
        if( $gallery){
            $dir = 'images/gallery-images/';
            if ($gallery->image != '' && File::exists($dir . $gallery->image)){
                File::delete($dir . $gallery->image);
            }
            $gallery->delete();
        }
        return redirect()->route('gallery.list')
        ->with('success', 'Gallery has been deleted!!');
    }
}
