<?php 
namespace App\Repository;

interface SiteoptionsInterface
{
	 /**
     * Get's a post by it's ID
     *
     * @param int
     */
    public function getsiteinfoById($site_id);
      

    public function update( $id,array $data);

      /**
     * Deletes a post.
     *
     * @param int
     */

    
}