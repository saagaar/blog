<?php 

namespace App\Repository\Contacts;

use App\Models\Contact;
use App\Repository\ContactInterface;

Class Contacts implements ContactInterface
{
	protected $Contact;

	public function __construct(Contact $Contact)
	{
		$this->Contact=$Contact;
	}

  /**
   * Get  Contact by id
   *
   * @param int
   */
  public function GetContactById($Contactid){
    return  $this->Contact->where('id', $Contactid)->first();
  }
     

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function GetAll(){
   	 return	$this->Contact->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function Create(array $data){
      return	$this->Contact->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function Update( $id,array $data){
      return	$this->Contact->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function Delete($id){
      return	$this->Contact->find($id)->delete();
    }
}
?>