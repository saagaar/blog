<?php 

namespace App\Repository\User;

use App\Models\User;
use App\Repository\UserInterface;

Class  Users implements UserInterface
{
	protected $user;

	public function __construct(User $user)
	{
		$this->user=$user;
	}

     
    public function getById($post_id){
        return false;
    }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	 $this->user->first();
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