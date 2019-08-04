<?php 

namespace App\Repository\Role;

use App\Models\Roles;
use App\Repository\RoleInterface;

Class Role implements RoleInterface
{
	protected $role;
	public function __construct(Roles $role)
	{
		$this->userrole=$role;
	}

  public function getroleById($role_id){
      return	$this->userrole->where('id', $role_id)->first();
    }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->userrole->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){
      return	$this->userrole->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
      return	$this->userrole->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return	$this->userrole->find($id)->delete();
    }
}
?>