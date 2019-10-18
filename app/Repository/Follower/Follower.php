<?php 

namespace App\Repository\Follower;

use App\Models\Users;
use App\Repository\FollowerInterface;

Class  Follower implements FollowerInterface
{
	protected $follower;

	public function __construct(Users $users)
	{
		$this->user=$users;
	}

    /**
     * check if current user $user_id is following following_id
     *
     * @return boolean
     */
    public function isFollowing($user,$following_id){
      return  $user->followings()->find($following_id);
    }

    /**
     * check if current user $user_id is following username
     *
     * @return boolean
     */
    public function isFollowingByUsername($user,$followingusername){
       
        return ($user->followings->where('username',$followingusername)->toArray());
    }
    /**
     * 
     */
 	public function getAllFollowers($user){
      return $user->followers()->withCount('followers')->get();
    }

    public function getFollowersCount($user){
      return $user->followers()->count();
    }

     public function getFollowingsCount($user){
      return $user->followings()->count();
    }
       /**
     * Get's all follow lists.
     *
     * @param int
     * @return mixed
     */

     public function getAllFollowings($user){
        return $user->followings()->withCount('followers')->get();
     }
 	  /**
     * Insert follower
     * @param 1 : integer
     * @param 2 : integer
     * @return mixed
     */
    public function followUser($user,$followerUsername){
       return  $user->followings()->attach($this->user->where('username',$followerUsername)->get());
    }
      /**
     * Unfollows  a user
     *
     * @param 1 Object
     * @param 2 int
     */
    public function unFollowUser($user,$followerUsername){
     return  $user->followings()->detach($this->user->where('username',$followerUsername)->get());
    }


    public function getFollowUserSuggestions($user,$limit=3,$head=0){
        $followcollection=array();
       
        $followers=$user->followings()->get()->pluck('pivot')->pluck('follow_id');
        return  $getfollowuser=$this->user->select('username','name')->whereNotIn('id',array($user->id))->whereNotIn('id',$followers)->skip($head-1)->take($limit)->get();
    }
}
?>