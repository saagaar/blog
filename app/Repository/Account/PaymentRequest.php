<?php 

namespace App\Repository\Account;
use App\Models\PaymentRequests;
use App\Repository\PaymentRequestInterface;
Class PaymentRequest implements PaymentRequestInterface
{
	protected $PaymentRequests;
	public function __construct(PaymentRequests $PaymentRequests){
		$this->PaymentRequests=$PaymentRequests;
	}
  
 
  public function getPendingRequest(){
   return $this->PaymentRequests->where('status','1')->get();
  }
  public function getAll(){
   return $this->PaymentRequests->get();
  }
  public function getAllWithUser($perPage=false){
   return $this->PaymentRequests->with('user:id,username,name')->paginate($perPage);
  }
	
	  /**
   * 
   *
   * @return mixed
   */
  public function create(array $data){
    return $this->PaymentRequests->create($data);
  }
   /**
   * Updates a post.
   *
   * @param int
   * @param array
   */

  public function update( $id,array $data){
    return $this->PaymentRequests->find($id)->update($data);
  }
    /**
   * Deletes a post.
   *
   * @param int
   */
  public function delete($id){
    return $this->PaymentRequests->find($id)->delete();
  }

}
?>