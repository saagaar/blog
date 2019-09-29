<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\NotificationSettingInterface;
use Illuminate\Http\Request;
use App\Http\Requests\NotificationRequest;
use Illuminate\Support\Facades\File;
use App;
class NotificationSettingController extends AdminController
{
    protected $notification;
    function __construct(NotificationSettingInterface $notification)
    {
         parent::__construct();
         $this->notification=$notification;
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All Notification Setting',
                      ]];
        $search = $request->get('search');
        if($search){
            $notification = $this->notification->getAll()
            ->where('code', 'like', '%' . $search . '%')
            ->orWhere('title', 'like', '%' . $search . '%')
            ->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $notification = $this->notification->getAll()->paginate($this->PerPage);
        }
        return view('admin.notification.list')->with(array('notification'=>$notification,'breadcrumb'=>$breadcrumb,'menu'=>'notification List','primary_menu'=>'notification.list'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs'=> 
                    [
                      'Dashboard'  => route('admin.dashboard'),
                      'All Notification Setting' => route('notification.list'),
                      'current_menu'  =>'Create notification',
                    ]];
        if ($request->method()=='POST') 
        {
            $requestObj=app(NotificationRequest::class);
            dd($requestObj->notification_type);
            $validatedData = $requestObj->validated();
            $this->notification->create($validatedData);
            return redirect()->route('notification.list')    
                             ->with(array('success'=>'Notification created successfully.','breadcrumb'=>$breadcrumb));
        }
        return view('admin.notification.create')->with(array('breadcrumb'=>$breadcrumb,'primary_menu'=>'notification.list'));
    }
   public function edit(Request $request, $id)
    {
            $breadcrumb=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'All Notification Setting' => route('notification.list'),
                        'current_menu'=>'Edit Notification Setting',
                          ]];
            $notification =$this->notification->getNotificationById($id);    
            if ($request->method()=='POST')
            {
                $requestObj=app(NotificationRequest::class);
                $validatedData = $requestObj->validated();
                $this->notification->update($id,$validatedData);
                return redirect()->route('notification.list')
                            ->with('success','Notification Setting Updated Successfully.');
            }
            return view('admin.notification.edit',compact('notification','breadcrumb'))->with(array('primary_menu'=>'notification.list'));
    }
    public function delete($id)
    {
        $notification =$this->notification->getNotificationById($id);       
        $notification->delete();        
        return redirect()->route('notification.list')
        ->with('success', 'Notification has been deleted!');
    }

       public function changeStatus(Request $request)
    {
        $notification = $this->notification->getNotificationById($request->id);
        $active = $request->status;
        $notification->update(array('active'=>$active));  
        return redirect()->route('notification.list')
                        ->with('success','Status change successfully.');
    }


}
