<?php 

namespace App\Repository\Helpcat;

use App\Models\HelpCategories;
use App\Repository\HelpCatInterface;

Class  HelpCat implements HelpCatInterface
{
	protected $cat;

	public function __construct(HelpCategories $helpCat)
	{
		$this->cat=$helpCat;
	}
  
  public function getCatById($helpcat_id){
      return	$this->cat->where('id', $helpcat_id)->first();
    }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->cat->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){
      return	$this->cat->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
      return	$this->cat->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return	$this->cat->find($id)->delete();
    }
}
?>