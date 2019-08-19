<?php 

namespace App\Repository\Blocklist;

use App\Models\Blocklists;
use App\Repository\BlocklistInterface;

Class Blocklist implements BlocklistInterface
{
	protected $blocklist;

	public function __construct(Blocklists $blocklist)
	{
		$this->blocklist=$blocklist;
	}

     
  public function GetIpById($ipaddress_id){
      return $this->blocklist->where('id', $ipaddress_id)->first();
    }

public function GetByIp($ipaddress){
      return $this->blocklist->where('ip_address', $ipaddress)->first();
    }
      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->blocklist->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){
      return	$this->blocklist->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
      return	$this->blocklist->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return	$this->blocklist->find($id)->delete();
    }
}
?>