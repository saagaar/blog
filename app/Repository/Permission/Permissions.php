<?php 

namespace App\Repository\permission;

use App\Models\Permission;
use App\Repository\PermissionInterface;

Class  Permissions implements permissionInterface
{
	protected $permission;

	public function __construct(Permission $permission)
	{
		$this->permission=$permission;
	}

     
    public function getById($permissionid){
      return $this->permission->where('id', $permissionid)->first();
    }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->permission->getPermissions();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){
      return $this->permission->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
         return $this->permission->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return    $this->permission->find($id)->delete();
    }
}
?>