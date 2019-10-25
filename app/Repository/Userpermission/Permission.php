<?php 

namespace App\Repository\Userpermission;

use App\Models\Permissions;
use App\Repository\PermissionInterface;

Class Permission implements PermissionInterface
{
	protected $permission;

	public function __construct(Permissions $permission)
	{
		$this->permission=$permission;
	}

     
    public function getById($permission_id){
      return $this->permission->where('id', $permission_id)->first();
    }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->permission->latest();
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