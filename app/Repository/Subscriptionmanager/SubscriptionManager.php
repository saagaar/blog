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
     * get subs data for unfollow
     */
    public function getSubscribeIdById($subscribable_id){
     return $this->Subscription->where(['subscribable_id'=>$subscribable_id,'comment'=>'Follow Subscription','type'=>3])->first();
    }
    /**
     * get active subs by category
     */
    public function getActiveSubsByCategory(){
     return $this->Subscription->where(['subscribable_type'=>'App\models\Categories','comment'=>'Category Subscription','type'=>2,'status'=>1])->get();
    }
    /**
     * get active subs by blog author
     */
    public function getActiveSubsByAuthor(){
     return $this->Subscription->where(['subscribable_type'=>'App\models\Users','comment'=>'User Subscription','type'=>3,'status'=>1])->get();
    }
      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
     return $this->Subscription->latest();
    }
    public function checkNewsletterSubscriptionInTable($email){
     return $this->Subscription->where(['email'=>$email,'type'=>1])->first();
    }
  
     /**
     * Update a post.
     *
     * @param int
     * @param array
     */
    public function create(array $data){
      return $this->Subscription->create($data);
    }

    public function update( $id,array $data){
         return $this->Subscription->find($id)->update($data);
    }
}
?>