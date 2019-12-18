<?php 
namespace App\Repository;

interface BannerInterface
{
	 /**
     * Get a post by it's ID
     *
     * @param int
     */
    public function getById($member_id);
      
      /**
     * Get all posts of banner
     *
     * @return mixed
     */
    public function getAll();
 	
 	  /**
     * create a post of banner
     *
     * @return mixed
     */
    public function create(array $data);
     /**
     * Updates a post of banner
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data);

      /**
     * Deletes a post of banner     *
     * @param int
     */
    public function delete($id);

    
}