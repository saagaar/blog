<?php 
namespace App\Repository;

interface TagInterface
{
	 /**
     * Get's a post by it's ID
     *
     * @param int
     */
    public function getTagById($tag_id);
      
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