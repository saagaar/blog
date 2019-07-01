<?php 

namespace App\Repository\Cms;

use App\Models\Cms;
use App\Repository\CmsInterface;

Class  Cms implements CmsInterface
{
	protected $cms;

	public function __construct(Cms $cms)
	{
		$this->cms=$cms;
	}

     
  public function getcmsById($cms_id){
      return	$this->cms->where('id', $cms_id)->first();
    }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->cms->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){
      return	$this->cms->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
      return	$this->cms->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return	$this->cms->find($id)->delete();
    }
}
?>