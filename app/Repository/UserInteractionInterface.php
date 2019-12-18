<?php 
namespace App\Repository;

interface UserInteractionInterface
{
      /**
     * check if user has category in interest by slug
     *
     * @param int
     * @return mixed
     */
      public function createCommment($data);
   /**
    * Get All User Interests
    */
     public function getLikeByBlog($blogid);
 	
 	  /**
     * add user interest
     * @param int
     * @return boolean
     */
    public function likeBlog($user,$blogid);

      /**
     * remove a user interest.
     *
     * @param int
     * @return boolean
     */
    public function unlikeBlog($user,$blogid);

    
}