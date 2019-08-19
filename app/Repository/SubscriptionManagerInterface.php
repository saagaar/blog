<?php 
namespace App\Repository;

interface SubscriptionManagerInterface
{
     /**
     * Get's a post by it's ID
     *
     * @param int
     */
    public function getById($subscription_id);
      
      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll();
    
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data);

    
}