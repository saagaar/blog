<?php 
namespace App\Repository\Adminrole;

// use App\Models\AdminRoles;
use App\Models\AdminRolePermissions;
use App\Repository\AdminRolePermissionInterface;

Class  AdminRolePermission implements AdminRolePermissionInterface
{
	// protected $ModulePermission;

	public function __construct(AdminRolePermissions $rolePermission)
	{
		$this->rolePermission=$rolePermission;
	}


  public function getModuleByRoleId($AdminRole_id){
      return	$this->rolePermission->where('role_id', $AdminRole_id)->first();
    }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll()
    {
   	 return	$this->rolePermission->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
   */  
    public function create(array $data){

      return $this->rolePermission->insert($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
      return $this->rolePermission->find($id)->update($data);
    }

      /**
     * Removes permission for specific role
     *
     * @param int
     */
    public function RemovePermission($role_id){
      return	$this->rolePermission->where('role_id',$role_id)->delete();
    }
     /**
     * Get Permission list by userid.
     *
     * @param User object
     * @return object
     */
    public function getModulePermissionListByUserId($role_id){
      return  $this->rolePermission->where('role_id', $role_id)->get();
    }

    /**
     * Get userHasPersmissionByRouteName list by Role id and Module Id.
     *
     * @var role_id
     * @var module_id
     * @return object
     */

    public function userHasPersmissionByRouteName($role_id,$module_id)
    {
      return   $this->rolePermission->where(['role_id'=> $role_id,'module_id'=>$module_id])->first();
    }
}
?>