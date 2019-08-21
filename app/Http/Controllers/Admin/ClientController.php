<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\ClientInterface;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\File;
use App;
class ClientController extends AdminController
{
    protected $Client;
    function __construct(ClientInterface $client)
    {
         parent::__construct();
         $this->Client=$client;
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All Clients',
                      ]];
        $search = $request->get('search');
        if($search){
            $Client = $this->Client->getAll()->where('title', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $Client = $this->Client->getAll()->paginate($this->PerPage);
        }
        return view('admin.client.list')->with(array('Client'=>$Client,'breadcrumb'=>$breadcrumb,'menu'=>'Client List'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs'=> 
                    [
                      'Dashboard'  => route('admin.dashboard'),
                      'All Clients' => route('client.list'),
                      'current_menu'  =>'Create Client',
                    ]];
        if ($request->method()=='POST') 
        {
            $requestobj=app(ClientRequest::class);
            $validatedData = $requestobj->validated();
            $logoName = time().'.'.request()->logo->getClientOriginalExtension();
            request()->logo->move(public_path('images/client-images'), $logoName);
            $validatedData['logo'] = $logoName;
            $this->Client->create($validatedData);
            return redirect()->route('client.list')    
                             ->with(array('success'=>'Client created successfully.','breadcrumb'=>$breadcrumb));
        }
        return view('admin.client.create')->with(array('breadcrumb'=>$breadcrumb));
    }
    public function edit(Request $request, $id)
    {
            $breadcrumb=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'All Clients' => route('client.list'),
                        'current_menu'=>'Edit Client',
                          ]];
            $client =$this->Client->getById($id);    
            if ($request->method()=='POST')
            {
                $requestobj=app(ClientRequest::class);
                $validatedData = $requestobj->validated();
                if($request->hasFile('logo')) {
                    $dir = 'images/client-images/';
                if ($client->logo != '' && File::exists($dir . $client->logo))             File::delete($dir . $client->logo);
                    $logoName = time().'.'.request()->logo->getClientOriginalExtension();
                    request()->logo->move(public_path('images/client-images'), $logoName);
                    $validatedData['logo'] = $logoName;
                }
                else 
                {
                    $validatedData['logo'] = $client->logo;
                }
                $this->Client->update($id,$validatedData);
                return redirect()->route('client.list')
                            ->with('success','Client Updated Successfully.');
            }
            return view('admin.client.edit',compact('client','breadcrumb'));
    }

    public function delete($id)
    {
       $client =$this->Client->getById($id);       
        if($client){
            $dir = 'images/client-images/';
            if ($client->logo != '' && File::exists($dir . $client->logo)){
                File::delete($dir . $client->logo);
            }
            $client->delete();
        }
        return redirect()->route('client.list')
        ->with('success', '');
    }

     public function changeStatus(Request $request)
    {
        $client = $this->Client->getById($request->id);
        $status = $request->status;
        $client->update(array('status'=>$status));  
       return redirect()->route('client.list')
                        ->with('success','Status change successfully.');
    }
}
