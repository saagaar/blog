<?php 
namespace App\Repository;

interface VisitorLogInterface
{
	 /**
     * Get's sitesettings by it's ID
     *
     * @param int
     */
    public function getLogById($id);
    
     /**
     * Updates Sitesettings.
     *
     * @param int,array()
     */


    public function GetAll();

    public function create(array $data);
    
    public function getLogbyIpAddressAndURL($userip,$urlpath);
}