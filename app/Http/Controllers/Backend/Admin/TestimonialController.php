<?php

namespace App\Http\Controllers\Backend\Admin;
use App\Http\Controllers\Backend\Admin\AdminController; 
use App\Repository\TestimonialInterface;
use Illuminate\Http\Request;
use App\Http\Requests\TestimonialRequest;
use Illuminate\Support\Facades\File;
use App;

class TestimonialController extends AdminController
{
     protected $testimony;

    function __construct(TestimonialInterface $testimony)
    {
         parent::__construct();
         $this->testimony=$testimony;
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All Testimonials',
                      ]];
        $search = $request->get('search');
        if($search){

            $Testimonial = $this->testimony->getAll()->where('title', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $Testimonial = $this->testimony->getAll()->paginate($this->PerPage);
        }
        return view('blog.listblog')->with(array('Testimonial'=>$Testimonial,'breadcrumb'=>$breadcrumb,'menu'=>'Blog List'));

    }
    public function create(Request $request,LocaleInterface $Locale)
    {
        $breadcrumb=['breadcrumbs'    => 
                    [
                      'Dashboard'     => route('admin.dashboard'),
                      'All Testimonials' => route('testimonial.list'),
                      'current_menu'  =>'Create Testimonial',
                    ]];
                    
        if ($request->method()=='POST') 
        {
            $requestobj=app(TestimonialRequest::class);
            $validatedData = $requestobj->validated();
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images/testimonialimages'), $imageName);
            $validatedData['image'] = $imageName;
            $this->testimony->create($validatedData);

            return redirect()->route('testimonial.list')
                             ->with(array('success'=>'testimonial created successfully.','breadcrumb'=>$breadcrumb));
        }
        $LocaleList=$Locale->getActiveLocale()->toArray();
        return view('blog.createblog')->with(array('breadcrumb'=>$breadcrumb,'localelist'=>$LocaleList));
    }
    public function edit(Request $request, $id,$slug,LocaleInterface $Locale)
    {
            $breadcrumb=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'All Blogs' => route('testimonial.list'),
                        'current_menu'=>'Edit Blog',
                          ]];
            $testimony =$this->testimony->GetBlogById($id);
            if ($request->method()=='POST') 
            {
                $requestobj=app(TestimonialRequest::class);
                $validatedData = $requestobj->validated();
                if ($request->hasFile('image')) {
                    $dir = 'images/blogimages/';
                    if ($testimony->image != '' && File::exists($dir . $testimony->image))
                    File::delete($dir . $testimony->image);

                    $imageName = time().'.'.request()->image->getClientOriginalExtension();
                    request()->image->move(public_path('images/blogimages'), $imageName);
                    $validatedData['image'] = $imageName;
                }else {
                    $validatedData['image'] = $testimony->image;
                }
                $testimony->update($validatedData);
                return redirect()->route('testimonial.list')
                            ->with('success','Blog Updated Successfully.');
            }
            $localelist=$Locale->getActiveLocale()->toArray();
            return view('blog.editblog',compact('blog','breadcrumb','localelist'));
    }
    public function delete($id)
    {
       $testimony =$this->testimony->GetBlogById($id);

        $result = $testimony->delete();
        if($result=='true'){
            $dir = 'images/blogimages/';
            if ($testimony->image != '' && File::exists($dir . $testimony->image)){
                File::delete($dir . $testimony->image);
            }
        }
        return redirect()->route('testimonial.list')
        ->with('success', 'Blog has been deleted!!');
    }
}
