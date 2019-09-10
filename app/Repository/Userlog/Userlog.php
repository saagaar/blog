<?php 

namespace App\Repository\Userlog;

use App\Models\Userlogs;
use App\Repository\UserlogInterface;

Class  Userlog implements UserlogInterface
{
	protected $log;

	public function __construct(Userlogs $websitelog)
	{
		$this->log=$websitelog;
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
}
?>