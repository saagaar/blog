<?php 
namespace App\Repository;

interface SiteoptionsInterface
{
	 /**
     * Get's sitesettings by it's ID
     *
     * @param int
     */
    public function GetSiteInfo();
    
     /**
     * Updates Sitesettings.
     *
     * @param int,array()
     */


    public function update(array $data);

     
    
}