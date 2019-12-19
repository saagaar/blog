<?php 

namespace App\Repository\Logactivity;

use App\Models\LogAdminActivities;
use App\Repository\LogActivityInterface;

Class  LogActivity implements LogActivityInterface
{
	protected $log;

	public function __construct(LogAdminActivities $logActivity)
	{
		$this->log=$logActivity;
	}

     
    public function getAll(){
   	 return	$this->log->latest();
    }
}
?>