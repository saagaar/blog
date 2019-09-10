<?php 
namespace App\Repository;

interface UserlogInterface
{
	 /**
     * Get's sitesettings by it's ID
     *
     * @param int
     */
    public function GetLogById($id);
    
     /**
     * Updates Sitesettings.
     *
     * @param int,array()
     */


    public function GetAll();

     
    
}