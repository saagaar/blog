<?php 
namespace App\Repository;

interface TeamInterface
{
	 /**
     * Get's a post by it's ID
     *
     * @param int
     */
    public function getById($member_id);
      
      /**
     * Get all posts.
     *
     * @return mixed
     */
    public function getAll();
 	
 	  /**
     * create a post
     *
     * @return mixed
     */
    public function create(array $data);
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data);

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id);

    
}