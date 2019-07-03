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
    public function getAll(){
      

   	 return	$this->ModulePermission->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
   */  
    public function create(array $data){
      return	$this->ModulePermission->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
      return	$this->ModulePermission->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return	$this->ModulePermission->find($id)->delete();
    }

     public function getModulePermissionListByUserId($user_id){
      return  $this->ModulePermission->where('user_id', $user_id)->all();
    }
}
?>