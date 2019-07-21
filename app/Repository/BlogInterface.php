<?php 
namespace App\Repository;

interface BlogInterface
{
	 /**
     * Get's a post by it's ID
     *
     * @param int
     */
    public function GetAssociatedCategoryOfBlog($blogid);
      
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