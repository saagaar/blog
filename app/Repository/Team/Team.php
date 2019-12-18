<?php 

namespace App\Repository\Team;

use App\Models\Teams;
use App\Repository\TeamInterface;

Class Team implements TeamInterface
{
	protected $Team;
	public function __construct(Teams $member)
	{
		$this->Team=$member;
	}

     
    public function getById($memberid){
      return $this->Team->where('id', $memberid)->first();
    }

      /**
     * Get id in team.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->Team->latest();
    }
 	
 	  /**
     * create a team 
     *
     * @return mixed
     */
    public function create(array $data){
      return $this->Team->create($data);
    }
     /**
     * Updates a team's data.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
         return $this->Team->find($id)->update($data);
    }

      /**
     * Delete a team's data.
     *
     * @param int
     */
    public function delete($id){
      return $this->Team->find($id)->delete();
    }
}
?>