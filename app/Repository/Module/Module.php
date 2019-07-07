<?php 

namespace App\Repository\Module;

use App\Models\ModulePermissions;
use App\Repository\ModuleInterface;

Class  Module implements ModuleInterface
{
	protected $module;

	public function __construct(ModulePermissions $module)
	{
		$this->module=$module;
	}

     
  public function getmoduleById($module_id){
      return	$this->module->where('id', $module_id)->first();
    }

      /**
     * Get's all Modules.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->module->latest();
    }
 	   /**
     * Get's all Mdules by route name.
     *@var Route Name string
     * @return mixed
     */ 
    public function getModuleByRouteName($routename){
     return $this->module->where('route_name', $routename)->first();
    }
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){
        $all =  $this->module->insert($data);
      // return $all;
     
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

    public function deleteAll()
    {
      return $this->module->getQuery()->delete();
    }
}
?>