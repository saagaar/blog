<?php 

namespace App\Repository\Role;

use App\Models\Role;
use App\Repository\RoleInterface;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Exceptions\GuardDoesNotMatch;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
Class Roles implements RoleInterface
{
	protected $role;
	public function __construct(Role $role)
	{
		$this->userrole=$role;
	}

  public function getroleById($id){
    // dd($role_id);
      return	$this->userrole->where('id', $id)->first();
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