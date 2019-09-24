<?php 
namespace App\Repository;

interface BlogInterface
{
     /**
     * Get  Blog by id
     *
     * @param int
     */
    public function getBlogById($blogid);
	 /**
     * Get all category  by it's ID
     *
     * @param int
     */
    public function getAssociatedCategoryOfBlog($blogid);
      
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