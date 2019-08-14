<?php 

namespace App\Repository\Client;

use App\Models\Clients;
use App\Repository\ClientInterface;

Class Client implements ClientInterface
{
	protected $Client;
	public function __construct(Clients $member)
	{
		$this->Client=$member;
	}

     
    public function getById($memberid){
      return $this->Client->where('id', $memberid)->first();
    }

      /**
     * Get id in client.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->Client->latest();
    }
 	
 	  /**
     * create a client
     *
     * @return mixed
     */
    public function create(array $data){
      return $this->Client->create($data);
    }
     /**
     * Updates a client's data.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
         return $this->Client->find($id)->update($data);
    }

      /**
     * Delete a client's data.
     *
     * @param int
     */
    public function delete($id){
      return $this->Client->find($id)->delete();
    }
}
?>