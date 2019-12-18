<?php 

namespace App\Repository\Seo;

use App\Models\Seos;
use App\Repository\SeoInterface;

Class  Seo implements SeoInterface
{
	protected $seo;

	public function __construct(Seos $seo)
	{
		$this->seo=$seo;
	}

     
    public function getSeoById($seoId){
      return $this->seo->where('id', $seoId)->first();
    }

    

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->seo->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){
      return $this->seo->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
         return $this->seo->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return    $this->seo->find($id)->delete();
    }
}
?>