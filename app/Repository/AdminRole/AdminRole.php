<?php 

namespace App\Repository\AdminRole;

use App\Models\AdminRoles;
use App\Repository\AdminRoleInterface;

Class  AdminRole implements AdminRoleInterface
{
	protected $role;
	public function __construct(AdminRoles $adminRole)
	{
		$this->role=$adminRole;
	}

  public function getRoleById($adminRole_id){
      return	$this->role->where('id', $adminRole_id)->first();
    }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->role->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){
      return	$this->role->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
      return	$this->role->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return	$this->role->find($id)->delete();
    }

    public function getPermissionsByRole($roleid){
      return $this->role->with('adminPermissions')->where('id',$roleid)->first();
    }
}
?>