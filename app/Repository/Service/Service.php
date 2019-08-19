<?php 

namespace App\Repository\Service;

use App\Models\Services;
use App\Repository\ServiceInterface;

Class Service implements ServiceInterface
{
	protected $Services;

	public function __construct(Services $services)
	{
		$this->Services=$services;
	}
 
    public function getById($servicesid){
      return $this->Services->where('id', $servicesid)->first();
    }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->Services->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){
      return $this->Services->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
         return $this->Services->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return $this->Services->find($id)->delete();
    }
}
?>