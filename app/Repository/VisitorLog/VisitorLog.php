<?php 
namespace App\Repository\VisitorLog;

use App\Models\VisitorLogs;
use App\Models\VisitorDetails;
use App\Models\Users;
use App\Repository\VisitorLogInterface;

Class  VisitorLog implements VisitorLogInterface
{
	protected $log;
    protected $users;
    protected $visitor;
    

	public function __construct(VisitorLogs $websiteLog, Users $users,VisitorDetails $visitor)
	{
		$this->log=$websiteLog;
        $this->users=$users;
         $this->visitor=$visitor;
               
	}

     
    public function getLogById($log_id)
    {
      return $this->log->where('id', $log_id)->first();
    }
    public function getUnupdateLog(){
        return  $this->log->where('country',Null)->get();
    }
    /**
     * Get's all log.
     *
     * @return mixed
    */
    public function getAll()
    {
   	 return	$this->log->latest();
    }
 
     public function countTodayLoggedInVisitors()
     {
         return $this->users->whereDate('last_login_date','=',date('Y-m-d'))->count();
     }
     

    public function countAllVisitors()
     {
         return $this->log->get()->count();
     }

      public function countTodaysPageVisitors()
     {
         return $this->visitor->whereDate('visit_date','=',date('Y-m-d'))->count(); 
     }


         
    
    /**
     * create user logs
     */

    public function create(array $data){
      return $this->log->create($data);
    }

    /**
     * to update logdata using jobs
     */
    public function update( $id,array $data){
         return $this->log->find($id)->update($data);
    }
    /**
     *  this returns the the ip details  of the 
     *  ip address passed through $ip and first log details using $url
     */
    public function getLogbyIpAddressAndURL($ip,$url){
        $data=$this->log->where('ip_address',$ip)->first();
        if(!$data)
          return false;
        $ipData['ip']=$data;
        $ipData['details']=$data->visitordetails->where('redirected_to',$url)->sortByDesc('created_at')->first();
        return $ipData;
    }
}
?>