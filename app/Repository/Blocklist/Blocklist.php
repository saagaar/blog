<?php 

namespace App\Repository\Blocklist;

use App\Models\Blocklists;
use App\Repository\BlocklistInterface;

Class Blocklist implements BlocklistInterface
{
	protected $blockList;

	public function __construct(Blocklists $blockList)
	{
		$this->blockList=$blockList;
	}

     
  public function getIpById($ipaddress_id){
      return $this->blockList->where('id', $ipaddress_id)->first();
    }

public function getByIp($ipaddress){
      return $this->blockList->where('ip_address', $ipaddress)->first();
    }
      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->blockList->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){
      return	$this->blockList->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
      return	$this->blockList->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return	$this->blockList->find($id)->delete();
    }
}
?>