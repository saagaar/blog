<?php 

namespace App\Repository\AdminPermission;

use App\Models\AdminPermissions;
use App\Repository\AdminPermissionInterface;

Class  AdminPermission implements AdminPermissionInterface
{
	protected $admin;

	public function __construct(AdminPermissions $admin)
	{
		$this->admin=$admin;
	}

     
  public function getmoduleById($permission_id){
      return	$this->admin->where('id', $permission_id)->first();
    }

      /**
     * Get's all Modules.
     *
     * @return mixed
     */
    public function getAll()
    {
   	 return	$this->admin->all();
    }
 	   /**
     * Get's all Mdules by route name.
     *@var Route Name string
     * @return mixed
     */ 
    public function getModuleByRouteName($routename){
     return $this->admin->where('route_name', $routename)->first();
    }
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){
        $all =  $this->admin->insert($data);
      // return $all;
     
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
      return	$this->admin->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return	$this->admin->find($id)->delete();
    }

    public function deleteAll()
    {
      return $this->admin->getQuery()->delete();
    }
}
?>