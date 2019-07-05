<?php 

namespace App\Repository\Blogcategories;

use App\Models\BlogCategory;
use App\Repository\BlogcategoriesInterface;

Class  Blogcategories implements BlogcategoriesInterface
{
	protected $cat;

	public function __construct(BlogCategory $blogcat)
	{
		$this->cat=$blogcat;
	}

     
  public function getcatById($blogcat_id){
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