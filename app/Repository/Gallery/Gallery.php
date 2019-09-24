<?php 

namespace App\Repository\Gallery;

use App\Models\Galleries;
use App\Repository\GalleryInterface;

Class  Gallery implements GalleryInterface
{
	protected $image;
	public function __construct(Galleries $image)
	{
		$this->image=$image;
	}

     
    public function getByImgId($imgid){
      return $this->image->where('id', $imgid)->first();
    }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->image->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){
      return $this->image->insert($data);
    }
     /**
     * Updates a gallery.
     *
     * @param array
     */

    public function update( $id,array $data){
         return $this->image->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param id
     * @param data
     */
    public function delete($id){
      return    $this->image->find($id)->delete();
    }
}
?>