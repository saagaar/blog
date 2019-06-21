<?php 

namespace App\Repository\User;

use App\Repository\UserRepositoryInterface;

Class  AdminUser implements UserRepositoryInterface
{
	protected $user;

	public function __construct(\AdminUser $adminUser)
	{
		$this->user=$adminUser;
	}

     
    public function getById($post_id){

    }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->user->all();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){

    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){

    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      
    }
}
?>