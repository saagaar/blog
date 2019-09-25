<?php 

namespace App\Repository\Category;

use App\Models\Categories;
use App\Repository\CategoryInterface;
Class Category implements CategoryInterface
{
	protected $cat;

	public function __construct(Categories $blogCat)
	{
		$this->cat=$blogCat;
	}

     
  public function getCatById($blogcat_id){
      return	$this->cat->where('id', $blogcat_id)->first();
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