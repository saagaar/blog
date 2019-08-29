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
            $Testimonial = $this->testimony->getAll()->where('name', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $Testimonial = $this->testimony->getAll()->paginate($this->PerPage);
        }
        return view('admin.testimonial.list')->with(array('testimony'=>$Testimonial,'breadcrumb'=>$breadcrumb,'menu'=>'testimonial List'));
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
            $requestobj=app(TestimonialRequest::class);
            $validatedData = $requestobj->validated();
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('frontend/images/testimonial-images'), $imageName);
            $validatedData['image'] = $imageName;
            $this->testimony->create($validatedData);
            return redirect()->route('testimonial.list')    
                             ->with(array('success'=>'testimonials created successfully.','breadcrumb'=>$breadcrumb));
        }
        return view('admin.testimonial.create')->with(array('breadcrumb'=>$breadcrumb));
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
                $requestobj=app(TestimonialRequest::class);
                $validatedData = $requestobj->validated();
                if ($request->hasFile('image')) {
                    $dir = 'frontend/images/testimonial-images/';
                    if ($testimony->image != '' && File::exists($dir . $testimony->image))
                    File::delete($dir . $testimony->image);
                    $imageName = time().'.'.request()->image->getClientOriginalExtension();
                    request()->image->move(public_path('frontend/images/testimonial-images'), $imageName);
                    $validatedData['image'] = $imageName;
                }else {
                    $validatedData['image'] = $testimony->image;
                }
                $this->testimony->update($id,$validatedData);
                return redirect()->route('testimonial.list')
                            ->with('success','testimonial Updated Successfully.');
            }
            return view('admin.testimonial.edit',compact('testimony','breadcrumb'));
    }
    public function delete($id)
    {
       $testimony =$this->testimony->getById($id);
        if($testimony){
            $dir = 'frontend/images/testimonial-images/';
            if ($testimony->image != '' && File::exists($dir . $testimony->image)){
                File::delete($dir . $testimony->image);
            }
            $testimony->delete();
        }
        return redirect()->route('testimonial.list')
        ->with('success', '');
    }

     public function changeStatus(Request $request)
    {
        $testimony = $this->testimony->getById($request->id);
        $status =$request->status;
        $testimony->update(array('status'=>$status)); 
        return redirect()->route('testimony.list')
                        ->with('success','Status change successfully.');
    } 
}
