<?php 

namespace App\Repository\email;

use App\Models\email;
use App\Repository\EmailInterface;

Class  Email implements EmailInterface
{
	protected $email;

	public function __construct(Email $email)
	{
		$this->email=$email;
	}

     
  public function getemailById($email_id){
      return	$this->email->where('id', $email_id)->first();
    }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->email->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){
      return	$this->email->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
      return	$this->email->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return	$this->email->find($id)->delete();
    }
}
?>