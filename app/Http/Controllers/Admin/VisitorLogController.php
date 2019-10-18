<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\BlocklistInterface; 
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\VisitorLogInterface;
class VisitorLogController extends AdminController
{
     protected $visitorLog;
    function __construct(VisitorLogInterface $websiteLog)
    {
         parent::__construct();
         $this->visitorLog=$websiteLog;
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All Website Logs List',
                      ]];
        $search = $request->get('search');
        if($search){
            $logs = $this->visitorLog->getAll()->where('ip_address', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }
        else{
            
            $logs = $this->visitorLog->getAll()->paginate($this->PerPage);
        }
        return view('admin.websitelog.list')->with(array('websiteLog'=>$logs,'breadcrumb'=>$breadcrumb,'menu'=>'logs List','primary_menu'=>'websitelog.list'));
    }
    public function View(Request $request,$id)
    {
        
        if($request->ajax()) {
            $websiteLog =$this->visitorLog->getLogById($id);
        $websiteLog['details'] = $websiteLog->visitordetails->sortByDesc('created_at')->first();
        }else{
           $websiteLog = $this->visitorLog->getLogById($id);
            $websiteLog['details'] = $websiteLog->visitordetails->sortByDesc('created_at')->first();
           
        }
        return $websiteLog;
    }
    public function block(BlocklistInterface $blockList,$id)
    {
        $adminId = auth()->user()->id;  

        $ipData =$this->visitorLog->getLogById($id);
                      
        if ($ipData) 
        {
            $ip=$blockList->getByIp($ipData->ip_address);
             
            if($ip)
            {
                if($ip->status=='black')
                {
                        return redirect()->route('blocklist.list')
                        ->with('error','Ip is already Blocked');
                }
                else
                    {
                     return redirect()->route('blocklist.list');
                    }
            }
            
            else {
                
                $data = array('ip_address'=>$ipData['ip_address'],'message'=>'Blocked By admin','status'=>'black','admin_id'=>$adminId);
                $blockList->create($data);
                return redirect()->route('blocklist.list')
                        ->with('success','Block List updated successfully.');
            }
        }
    }
    
}
