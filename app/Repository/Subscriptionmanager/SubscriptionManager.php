<?php 

namespace App\Repository\SubscriptionManager;

use App\Models\SubscriptionManagers;
use App\Repository\SubscriptionManagerInterface;

Class SubscriptionManager implements SubscriptionManagerInterface
{
  protected $Subscription;
  public function __construct(SubscriptionManagers $member)
  {
    $this->Subscription=$member;
  }
  
    public function getById($memberid){
      return $this->Subscription->where('id', $memberid)->first();
    }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
     return $this->Subscription->latest();
    }
  
     /**
     * Update a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
         return $this->Subscription->find($id)->update($data);
    }
}
?>