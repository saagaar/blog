<?php 

namespace App\Repository\Language;

use App\Models\Languages;
use App\Repository\LanguageInterface;

Class Language implements LanguageInterface
{
	protected $Language;
	public function __construct(Languages $member)
	{
		$this->Language=$member;
	}

     
    public function getById($memberid){
      return $this->Language->where('id', $memberid)->first();
    }

      /**
     * Get id from Language.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->Language->latest();
    }
 	
 	  /**
     * create a post of Language
     *
     * @return mixed
     */
    public function create(array $data){
      return $this->Language->create($data);
    }
     /**
     * Updates a Payment Gateway's data.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
         return $this->Language->find($id)->update($data);
    }

      /**
     * Delete a Payment Gateway's data.
     *
     * @param int
     */
    public function delete($id){
      return $this->Language->find($id)->delete();
    }
}
?>