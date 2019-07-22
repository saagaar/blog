<?php 
namespace App\Repository\ModuleRole;

// use App\Models\AdminRoles;
use App\Models\ModuleRolePermissions;
use App\Repository\ModuleRolePermissionInterface;

Class  ModuleRolePermission implements ModuleRolePermissionInterface
{
	// protected $ModulePermission;

	public function __construct(ModuleRolePermissions $ModulePermission)
	{
		$this->ModulePermission=$ModulePermission;
	}


  public function getModuleByRoleId($AdminRole_id){
      return	$this->ModulePermission->where('role_id', $AdminRole_id)->first();
    }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll()
    {
   	 return	$this->ModulePermission->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
   */  
    public function create(array $data){

      return $this->ModulePermission->insert($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
      return $this->ModulePermission->find($id)->update($data);
    }

      /**
     * Removes permission for specific role
     *
     * @param int
     */
    public function RemovePermission($role_id){
      return	$this->ModulePermission->where('role_id',$role_id)->delete();
    }
     /**
     * Get Permission list by userid.
     *
     * @param User object
     * @return object
     */
    public function getModulePermissionListByUserId($role_id){
      return  $this->ModulePermission->where('role_id', $role_id)->get();
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
      return   $this->ModulePermission->where(['role_id'=> $role_id,'module_id'=>$module_id])->first();
    }
}
?>