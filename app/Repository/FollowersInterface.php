<?php 
namespace App\Repository;

interface FollowerInterface
{
	 /**
     * Get's a post by it's ID
     *
     * @param int
     */
    public function getByFollowId($followid);
      
      /**
     * Get's all posts.
     *
     * @return mixed
     */

     /**
      * 
      */
     public function getByFollowerId($followerid);
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create($userid,$followid);

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($userid);

    
}