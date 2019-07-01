<?php 

namespace App\Repository\Module;

use App\Models\ModulePermission;
use App\Repository\ModuleInterface;

Class  Module implements ModuleInterface
{
	protected $module;

	public function __construct(ModulePermission $Module)
	{
		$this->module=$Module;
	}

     
  public function getmoduleById($module_id){
      return	$this->module->where('id', $module_id)->first();
    }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->module->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){
      return	$this->module->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
      return	$this->module->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return	$this->module->find($id)->delete();
    }
}
?>