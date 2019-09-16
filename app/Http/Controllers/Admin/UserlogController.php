<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\BlocklistInterface; 
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\UserlogInterface;
class UserlogController extends AdminController
{
     protected $websiteLog;
    function __construct(UserlogInterface $websiteLog)
    {
         parent::__construct();
         $this->userLog=$websiteLog;
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All Website Logs List',
                      ]];
        $search = $request->get('search');
        if($search){
            $logs = $this->userLog->getAll()->where('ip_address', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $logs = $this->userLog->getAll()->paginate($this->PerPage);
        }
        return view('admin.websitelog.list')->with(array('websitelog'=>$logs,'breadcrumb'=>$breadcrumb,'menu'=>'logs List'));
    }
    public function View(Request $request,$id)
    {
        
        if($request->ajax()) {
            $websiteLog =$this->userLog->GetLogById($id);
        $websiteLog['details'] = $websiteLog->logdetails->sortByDesc('created_at')->first();
        }else{
           $websiteLog = $this->userLog->GetLogById($id);
            $websiteLog['details'] = $websiteLog->logdetails->sortByDesc('created_at')->first();
           
        }
        return $websiteLog;
    }
    public function block(BlocklistInterface $blocklist,$id)
    {
        $admin_id = auth()->user()->id;
        $ipdata =$this->userLog->GetLogById($id);
        
        if ($ipdata) 
        {
            $ip = $blocklist->GetByIp($ipdata->ip_address);
            if($ip){
                if($ip->status=='black'){
                return redirect()->route('blocklist.list')
                        ->with('error','Ip is already Blocked');
                }else{
                    return redirect()->route('blocklist.list');
                }
            }else {
                
                $data = array('ip_address'=>$ipdata['ip_address'],'message'=>'Blocked By admin','status'=>'black','admin_id'=>$admin_id);
                $blocklist->create($data);
                return redirect()->route('blocklist.list')
                        ->with('success','Block List updated successfully.');
            }
        }
    }
    
}
