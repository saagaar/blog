<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
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
            $testimonial = $this->testimony->getAll()->where('name', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
           
        }else{
            $testimonial = $this->testimony->getAll()->paginate($this->PerPage);
        }
        return view('admin.testimonial.list')->with(array('testimony'=>$testimonial,'breadcrumb'=>$breadcrumb,'menu'=>'testimonial List','primary_menu'=>'testimonial.list'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs'=> 
                    [
                      'Dashboard'  => route('admin.dashboard'),
                      'All Testimonials' => route('testimonial.list'),
                      'current_menu'  =>'Create Testimonial',
                    ]];
        if ($request->method()=='POST') 
        {
 
            $requestObj=app(TestimonialRequest::class);
            $validatedData = $requestObj->validated();
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('uploads/testimonial-images'), $imageName);
            $validatedData['image'] = $imageName;
            $this->testimony->create($validatedData);
            return redirect()->route('testimonial.list')    
                             ->with(array('success'=>'Testimonial created successfully.','breadcrumb'=>$breadcrumb));
        }
        return view('admin.testimonial.create')->with(array('breadcrumb'=>$breadcrumb,'primary_menu'=>'testimonial.list'));
    }
    public function edit(Request $request, $id)
    {
            $breadcrumb=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'All Testimonial' => route('testimonial.list'),
                        'current_menu'=>'Edit Testimonial',
                          ]];
            $testimony =$this->testimony->getById($id);    
            if ($request->method()=='POST')
            {
              
                $requestObj=app(TestimonialRequest::class);
                $validatedData = $requestObj->validated();
                if ($request->hasFile('image')){

                    $dir = 'uploads/testimonial-images/';
                    if ($testimony->image != '' && File::exists($dir . $testimony->image))
                          File::delete($dir . $testimony->image);
                    $imageName = time().'.'.request()->image->getClientOriginalExtension();
                    request()->image->move(public_path('uploads/testimonial-images'), $imageName);
                    $validatedData['image'] = $imageName;
                }
                else {
                    $validatedData['image'] = $testimony->image;
                }
                $this->testimony->update($id,$validatedData);
                return redirect()->route('testimonial.list')
                            ->with('success','Testimonial Updated Successfully.');
            }
            return view('admin.testimonial.edit',compact('testimony','breadcrumb'))->with(array('primary_menu'=>'testimonial.list'));
    }
    public function delete($id)
    {
       $testimony =$this->testimony->getById($id);
        if($testimony){
            $dir = 'uploads/testimonial-images/';
            if ($testimony->image != '' && File::exists($dir . $testimony->image)){
                File::delete($dir . $testimony->image);
            }
            $testimony->delete();
        }
        return redirect()->route('testimonial.list')
        ->with('success', 'Testimonial has been deleted!!');
    }

     public function changeStatus(Request $request)
    {
        $testimony =$this->testimony->getById($request->id);
        $status =$request->status;
        $testimony->update(array('status'=>$status)); 
        return ['status'=>true,'message'=>'Status Updated Successfully'];      
    } 
}
