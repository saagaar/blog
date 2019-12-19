<?php 
namespace App\Repository;

interface ContactInterface
{
     /**
     * Get  Contact by id
     *
     * @param int
     */
    public function getContactById($contactid);
	 /**
     * Get all category  by it's ID
     *
     * @param int
     */
      
      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll();
 	
 	  /**
     * create a 
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