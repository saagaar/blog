<?php 

namespace App\Repository\User;

use App\Models\AdminUsers;
use App\Repository\UserInterface;

Class  AdminUser implements UserInterface
{
	protected $user;

	public function __construct(AdminUsers $adminUser)
	{
		$this->user=$adminUser;
	}

     
    public function getById($memberid){

    }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->user->first();
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