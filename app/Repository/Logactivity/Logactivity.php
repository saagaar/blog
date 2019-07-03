<?php 

namespace App\Repository\Logactivity;

use App\Models\LogAdminActivitys;
use App\Repository\LogactivityInterface;

Class  Logactivity implements LogactivityInterface
{
	protected $Logactivity;

	public function __construct(LogAdminActivitys $Logactivity)
	{
		$this->log=$Logactivity;
	}

     
    public function getAll(){
   	 return	$this->log->latest();
    }
}
?>