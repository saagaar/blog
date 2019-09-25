<?php 
namespace App\Repository;

interface SiteoptionInterface
{
	 /**
     * Get's sitesettings by it's ID
     *
     * @param int
     */
    public function getSiteInfo();
    
     /**
     * Updates Sitesettings.
     *
     * @param int,array()
     */


    public function update(array $data);

     
    
}