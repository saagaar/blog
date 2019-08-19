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
      return $this->user->where('id', $memberid)->first();
    }

    
    public function getByEmail($email){
      return $this->user->where('email', $email)->first();
    }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->user->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){
      return $this->user->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
         return $this->user->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return    $this->user->find($id)->delete();
    }
}
?>