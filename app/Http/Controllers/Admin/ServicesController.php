<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\ServiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\ServicesRequest;
use Illuminate\Support\Facades\File;
use App;

class ServicesController extends AdminController
{
    protected $Service;
    
    function __construct(ServiceInterface $services)
    {
         parent::__construct();
         $this->Service=$services;
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All services',
                      ]];
        $search = $request->get('search');
        if($search){
            $services = $this->Service->getAll()->where('title', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $services = $this->Service->getAll()->paginate($this->PerPage);
        }
        return view('admin.services.list')->with(array('Service'=>$services,'breadcrumb'=>$breadcrumb,'menu'=>'services List'));
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
            $requestobj=app(ServicesRequest::class);
            $validatedData = $requestobj->validated();
            $iconName = time().'.'.request()->icon->getClientOriginalExtension();
            request()->icon->move(public_path('images/services-images'), $iconName);
            $validatedData['icon'] = $iconName;
            $this->Service->create($validatedData);
            return redirect()->route('services.list')    
                             ->with(array('success'=>'Services created successfully.','breadcrumb'=>$breadcrumb));
        }
        return view('admin.services.create')->with(array('breadcrumb'=>$breadcrumb));
    }
    public function edit(Request $request, $id)
    {
            $breadcrumb=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'All services' => route('services.list'),
                        'current_menu'=>'Edit services',
                          ]];
            $service =$this->Service->getById($id);    
            if ($request->method()=='POST')
            {
                $requestobj=app(servicesRequest::class);
                $validatedData = $requestobj->validated();
                if ($request->hasFile('icon')) {
                    $dir = 'images/services-images/';
                    if ($service->icon != '' && File::exists($dir . $service->icon))
                    File::delete($dir . $service->icon);
                    $iconName = time().'.'.request()->icon->getClientOriginalExtension();
                    request()->icon->move(public_path('images/services-images'), $iconName);
                    $validatedData['icon'] = $iconName;
                }else {
                    $validatedData['icon'] = $service->icon;
                }
                $this->Service->update($id,$validatedData);
                return redirect()->route('services.list')
                            ->with('success','Services Updated Successfully.');
            }
            return view('admin.services.edit',compact('service','breadcrumb'));
    }
    public function delete($id)
    {
       $services=$this->Service->getById($id);
        if($services){
            $dir = 'images/services-images/';
            if ($services->icon != '' && File::exists($dir . $services->icon)){
                File::delete($dir . $services->icon);
            }   
            $services->delete();
        }
        return redirect()->route('services.list')
        ->with('success', '');
    }
}
