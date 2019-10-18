<?php 
namespace App\Repository;

interface FollowerInterface
{
	 /**
     * check if user is following another user
     *
     * @param 1 int
     * @param 2 int
     */
    public function isFollowing($userid,$followid);
      
      /**
     * Get's all Followers.
     * @param int
     * @return mixed
     */

   
     public function getAllFollowers($userid);

      /**
     * Get's all follow lists.
     *
     * @param int
     * @return mixed
     */

   
     public function getAllFollowings($userid);
 	
 	  /**
     * Follow user
     * @param int
     * @return boolean
     */
    public function followUser($userid,$followid);

      /**
     * Unfollows a user.
     *
     * @param int
     * @return boolean
     */
    public function unFollowUser($userid,$followid);

    
}