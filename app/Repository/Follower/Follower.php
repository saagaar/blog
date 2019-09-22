<?php 

namespace App\Repository\Follower;

use App\Models\Followers;
use App\Repository\FollowerInterface;

Class  Follower implements FollowerInterface
{
	protected $follower;
	public function __construct(Followers $follower)
	{
		$this->follower=$follower;
	}

     
    public function getByFollowId($following_id){
      return $this->follower->where('user_id', $following_id)->all();
    }


    /**
     * 
     */
 	public function getByFollowerId($follower_id){
      return $this->follower->where('follow_id', $follower_id)->all();
    }
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create($user_id,$follow_id){
    	$followdata = $this->getByFollowId($user_id);
    	if ($followdata->follow_id != $follow_id) {
    		return $this->follower->create($user_id,$follow_id);
    	}
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($user_id,$follow_id){
      return  $this->follower->find($user_id,$follow_id)->delete();
    }
}
?>