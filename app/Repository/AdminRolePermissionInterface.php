<?php 
namespace App\Repository;

interface AdminRolePermissionInterface
{
	
      
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
     * Deletes all Permision for a specifc role.
     *
     * @param int
     */
    public function RemovePermission($role_id);

    
    
}