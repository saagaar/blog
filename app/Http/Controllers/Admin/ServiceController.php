<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\ServiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\ServicesRequest;
use Illuminate\Support\Facades\File;
use App;

class ServiceController extends AdminController
{
    protected $service;
    
    function __construct(ServiceInterface $services)
    {
         parent::__construct();
         $this->service=$services;
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All services',
                      ]];
        $search = $request->get('search');
        if($search){
            $services = $this->service->getAll()->where('title', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $services = $this->service->getAll()->paginate($this->PerPage);
        }
        return view('admin.service.list')->with(array('service'=>$services,'breadcrumb'=>$breadcrumb,'menu'=>'Services List','primary_menu'=>'services.list'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs'=> 
                    [
                      'Dashboard'  => route('admin.dashboard'),
                      'All services' => route('services.list'),
                      'current_menu'  =>'Create services',
                    ]];
        if ($request->method()=='POST')
        {
    
            $requestObj=app(ServicesRequest::class);
            $validatedData = $requestObj->validated();
            $imageName = time().'.'.request()->icon->getClientOriginalExtension();
            request()->icon->move(public_path('uploads/services-images'), $imageName);
            $validatedData['icon'] = $imageName;
            $this->service->create($validatedData);
            return redirect()->route('services.list')    
                             ->with(array('success'=>'Service created successfully.','breadcrumb'=>$breadcrumb));
        }
        return view('admin.service.create')->with(array('breadcrumb'=>$breadcrumb,'primary_menu'=>'service.list'));
    }
    public function edit(Request $request, $id)
    {
            $breadcrumb=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'All services' => route('services.list'),
                        'current_menu'=>'Edit services',
                          ]];
            $service =$this->service->getById($id);    
            if ($request->method()=='POST')
            {
                
                $requestObj=app(servicesRequest::class);
                $validatedData = $requestObj->validated();
                if ($request->hasFile('icon')) {
                    $dir = 'uploads/services-images/';
                    if ($service->icon != '' && File::exists($dir . $service->icon))
                    File::delete($dir . $service->icon);
                    $iconName = time().'.'.request()->icon->getClientOriginalExtension();
                    request()->icon->move(public_path('uploads/services-images'), $iconName);
                    $validatedData['icon'] = $iconName;
                }else {
                    $validatedData['icon'] = $service->icon;
                }
                $this->service->update($id,$validatedData);
                return redirect()->route('services.list')
                            ->with('success','Services Updated Successfully.');
            }
            return view('admin.service.edit',compact('service','breadcrumb'))->with(array('primary_menu'=>'service.list'));;
    }
    public function delete($id)
    {
       $services=$this->service->getById($id);
        if($services){
            $dir = 'uploads/services-images/';
            if ($services->icon != '' && File::exists($dir . $services->icon)){
                File::delete($dir . $services->icon);
            }   
            $services->delete();
        }
        return redirect()->route('services.list')
        ->with('success', 'Services has been deleted!');
    }

     public function changeStatus(Request $request)
    {
        $changetatus = $this->service->getById($request->id);
        $status = $request->status;
        $changetatus->update(array('status'=>$status)); 
        return redirect()->route('services.list')
                        ->with('success','Status change successfully.');
    }
}
