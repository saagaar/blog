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
    protected $client;
    function __construct(ClientInterface $client)
    {
         parent::__construct();
         $this->client=$client;
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All Clients',
                      ]];
        $search = $request->get('search');
        if($search){
          $client = $this->client->getAll()->where('title', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }
        else{
            $client = $this->client->getAll()->paginate($this->PerPage);
            }
              return view('admin.client.list')->with(array('client'=>$client,'breadcrumb'=>$breadcrumb,'menu'=>'Client List','primary_menu'=>'client.list'));
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
            $requestObj=app(ClientRequest::class);
            $validatedData = $requestObj->validated();
            $logoName = time().'.'.request()->logo->getClientOriginalExtension();
            request()->logo->move(public_path('uploads/client-images'), $logoName);
            $validatedData['logo'] = $logoName;
            $this->client->create($validatedData);
            return redirect()->route('client.list')    
                             ->with(array('success'=>'Client created successfully.','breadcrumb'=>$breadcrumb));
        }
        return view('admin.client.create')->with(array('breadcrumb'=>$breadcrumb,'primary_menu'=>'client.list'));
    }
    public function edit(Request $request, $id)
    {
            $breadcrumb=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'All Clients' => route('client.list'),
                        'current_menu'=>'Edit Client',
                          ]];
            $client =$this->client->getById($id);    
            if ($request->method()=='POST')
            {
                $requestObj=app(ClientRequest::class);
                $validatedData = $requestObj->validated();
                if($request->hasFile('logo')) {
                    $dir = 'uploads/client-images/';
                if ($client->logo != '' && File::exists($dir . $client->logo))             File::delete($dir . $client->logo);
                    $logoName = time().'.'.request()->logo->getClientOriginalExtension();
                    request()->logo->move(public_path('uploads/client-images'), $logoName);
                    $validatedData['logo'] = $logoName;
                }
                else 
                {
                    $validatedData['logo'] = $client->logo;
                }
                $this->client->update($id,$validatedData);
                return redirect()->route('client.list')
                            ->with('success','Client Updated Successfully.');
            }
            return view('admin.client.edit',compact('client','breadcrumb'))->with(array('primary_menu'=>'client.list'));
    }

    public function delete($id)
    {
       $client =$this->client->getById($id);       
        if($client){
            $dir = 'uploads/client-images/';
            if ($client->logo != '' && File::exists($dir . $client->logo)){
                File::delete($dir . $client->logo);
            }
            $client->delete();
        }
        return redirect()->route('client.list')
        ->with('success', 'Client had been deleted!');
    }

     public function changeStatus(Request $request)
    {
        $client = $this->client->getById($request->id);
        $status = $request->status;
        $client->update(array('status'=>$status));  
       return redirect()->route('client.list')
                        ->with('success','Status change successfully.');
    }
}
