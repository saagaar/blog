<?php 

namespace App\Repository\PaymentGateway;

use App\Models\PaymentGateways;
use App\Repository\PaymentGatewayInterface;

Class PaymentGateway implements PaymentGatewayInterface
{
	protected $PaymentGateway;
	public function __construct(PaymentGateways $member)
	{
		$this->PaymentGateway=$member;
	}

     
    public function getById($memberid){
      return $this->PaymentGateway->where('id', $memberid)->first();
    }

      /**
     * Get id from PaymentGateway.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->PaymentGateway->latest();
    }
 	
 	  /**
     * create a post of PaymentGateway
     *
     * @return mixed
     */
    public function create(array $data){
      return $this->PaymentGateway->create($data);
    }
     /**
     * Updates a Payment Gateway's data.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
         return $this->PaymentGateway->find($id)->update($data);
    }

      /**
     * Delete a Payment Gateway's data.
     *
     * @param int
     */
    public function delete($id){
      return $this->PaymentGateway->find($id)->delete();
    }
}
?>