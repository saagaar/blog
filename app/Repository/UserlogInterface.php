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

    public function create(array $data);
    
    public function update( $id,array $data);
    
    public function getLogbyIpAddressAndURL($userip,$urlpath);
}