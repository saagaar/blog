<?php 
namespace App\Repository;

interface ContactInterface
{
     /**
     * Get  Contact by id
     *
     * @param int
     */
    public function GetContactById($contactid);
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
    public function GetAll();
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function Create(array $data);
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function Update( $id,array $data);

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function Delete($id);

    
}