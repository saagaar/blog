    <?php 

namespace App\Repository\Admin;

use App\Models\AdminRoles;
use App\Repository\AdminRoleInterface;

Class  AdminRole implements AdminRoleInterface
{
	protected $role;
	public function __construct(AdminRoles $AdminRole)
	{
		$this->role=$AdminRole;
	}

  public function getroleById($AdminRole_id){
      return	$this->role->where('id', $AdminRole_id)->first();
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
}
?>