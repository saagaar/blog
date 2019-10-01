<?php 

namespace App\Repository\Visitorlog;

use App\Models\VisitorLogs;
use App\Repository\VisitorLogInterface;

Class  VisitorLog implements VisitorLogInterface
{
	protected $log;

	public function __construct(VisitorLogs $websiteLog)
	{
		$this->log=$websiteLog;
	}

     
    public function getLogById($log_id){
      return $this->log->where('id', $log_id)->first();
    }

    /**
     * Get's all log.
     *
     * @return mixed
    */
    public function getAll(){
   	 return	$this->log->latest();
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