<?php 

namespace App\Repository\Seo;

use App\Models\Seos;
use App\Repository\SeoInterface;

Class  Seo implements SeoInterface
{
	protected $seo;

	public function __construct(Seos $Seo)
	{
		$this->seo=$Seo;
	}

     
    public function GetSeoById($seoid){
      return $this->seo->where('id', $seoid)->first();
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