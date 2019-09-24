<?php 

namespace App\Repository\GalleryCategory;

use App\Models\GalleryCategories;
use App\Repository\GallerycatInterface;

Class  GalleryCategory implements GallerycatInterface
{
	protected $category;
	public function __construct(GalleryCategories $category)
	{
		$this->category=$category;
	}

     
    public function getByCatId($catId){
      return $this->category->where('id', $catId)->first();
    }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->category->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){
      return $this->category->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
         return $this->category->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return    $this->category->find($id)->delete();
    }
}
?>