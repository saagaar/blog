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

     
    public function GetLogById($log_id){
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
    public function create(array $data){
      return $this->log->create($data);
    }
    public function getLogbyIpAddressAndURL($ip,$url){
        $data=$this->log->where('ip_address',$ip)->first();
        if(!$data)
          return false;
        $ipData['ip']=$data;
        $ipData['details']=$data->logdetails->where('redirected_to',$url)->sortByDesc('created_at')->first();
        return $ipData;

    }
}
?>