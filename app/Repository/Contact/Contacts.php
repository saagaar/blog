<?php 

namespace App\Repository\Contact;

use App\Models\Contact;
use App\Repository\ContactInterface;

Class Contacts implements ContactInterface
{
	protected $contact;

	public function __construct(Contact $contact)
	{
		$this->contact=$contact;
	}

  /**
   * Get  Contact by id
   *
   * @param int
   */
  public function getContactById($contactId){
    return  $this->contact->where('id', $contactId)->first();
  }
     

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->contact->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){
      return	$this->contact->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
      return	$this->contact->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return	$this->contact->find($id)->delete();
    }
}
?>