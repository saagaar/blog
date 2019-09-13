<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\BlocklistInterface; 
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\UserlogInterface;
class UserlogController extends AdminController
{
     protected $websitelog;
      protected $blocklist;
    function __construct(UserlogInterface $websitelog,BlocklistInterface $blocklist)
    {
         parent::__construct();
         $this->blocklist=$blocklist;
         $this->userlog=$websitelog;
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All Website Logs List',
                      ]];
        $search = $request->get('search');
        if($search){
            $logs = $this->userlog->getAll()->where('ip_address', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $logs = $this->userlog->getAll()->paginate($this->PerPage);
        }
        return view('admin.websitelog.list')->with(array('websitelog'=>$logs,'breadcrumb'=>$breadcrumb,'menu'=>'logs List'));
    }
    public function View($id)
    {
        $websitelog =$this->userlog->GetLogById($id);
        $websitelog['details'] = $websitelog->logdetails->sortByDesc('created_at')->first();
        return $websitelog;
    }
    public function block($id)
    {
        $admin_id = auth()->user()->id;
        $ipdata =$this->userlog->GetLogById($id);
        
        if ($ipdata) 
        {
            $ip = $this->blocklist->GetByIp($ipdata->ip_address);
            if($ip){
                if($ip->status=='black'){
                return redirect()->route('blocklist.list')
                        ->with('error','Ip is already Blocked');
                }else{
                    return redirect()->route('blocklist.list');
                }
            }else {
                
                $data = array('ip_address'=>$ipdata['ip_address'],'message'=>'Blocked By admin','status'=>'black','admin_id'=>$admin_id);
                $this->blocklist->create($data);
                return redirect()->route('blocklist.list')
                        ->with('success','Block List updated successfully.');
            }
        }
    }
    
}
