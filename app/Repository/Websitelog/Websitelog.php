<?php 

namespace App\Repository\Websitelog;

use App\Models\Websitelogs;
use App\Repository\WebsitelogInterface;

Class  Websitelog implements WebsitelogInterface
{
	protected $log;

	public function __construct(Websitelogs $websitelog)
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