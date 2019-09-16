<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController; 
use App\Repository\SubscriptionManagerInterface;
use Illuminate\Http\Request;
use App\Http\Requests\SubscriptionManagerRequest;
use Illuminate\Support\Facades\File;
use App;

class SubscriptionController extends AdminController
{
    protected $subscriptionManager;
     public function __construct(SubscriptionManagerInterface $subscriptionManager)
    {
         parent::__construct();
         $this->subscriptionManager=$subscriptionManager;
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All Subscription Manager',
                      ]];
        $search = $request->get('search');
        if($search){
            $Subscription = $this->subscriptionManager->getAll()->where('email', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $Subscription = $this->subscriptionManager->getAll()->paginate($this->PerPage);
        }
        return view('admin.subscriptionmanager.list')->with(array('Subscription'=>$Subscription,'breadcrumb'=>$breadcrumb,'menu'=>'Subscription List'));
    }
 
    public function edit(Request $request, $id)
    {
            $breadcrumb=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'All SubscriptionManager' => route('subscription.list'),
                        'current_menu'=>'Edit Subscription Manager',
                          ]];
            $subscription=$this->subscriptionManager->getById($id);                  
          if ($request->method()=='POST')
            {
                $requestobj=app(SubscriptionManagerRequest::class);
                $validatedData = $requestobj->validated();
                $this->subscriptionManager->update($id,$validatedData);
                return redirect()->route('subscription.list')
                            ->with('success','Subscription Updated Successfully.');
            }
            return view('admin.subscriptionmanager.edit',compact('subscription','breadcrumb'));
    }

    public function changeStatus(Request $request)
    {
        $subscription = $this->subscriptionManager->getById($request->id);
        $status = $request->status;
        $subscription->update(array('status'=>$status)); 
        return redirect()->route('subscription.list')
                        ->with('success','Status change successfully.');
    } 
           
}
