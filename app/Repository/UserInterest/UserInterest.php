<?php 

namespace App\Repository\UserInterest;

use App\Models\Categories;
use App\Repository\UserInterestInterface;

Class  UserInterest implements UserInterestInterface
{
	protected $interest;

	public function __construct(Categories $categories)
	{
		$this->categories=$categories;
	}

    /**
     * check if current user $user_id is following following_id
     *
     * @return boolean
     */
    public function isInterest($user,$category_id){
      return  $user->userInterests()->find($category_id);
    }

    /**
     * check if current user $user_id is following username
     *
     * @return boolean
     */
    public function isAddedBySlug($user,$slug){

   
        return ($user->userInterests()->where('slug',$slug)->get());
    }
       /**
     * Get's all follow lists.
     *
     * @param int
     * @return mixed
     */

     public function getAllInterests($user){
        return $user->userInterests()->get();
     }
 	  /**
     * Insert follower
     * @param 1 : integer
     * @param 2 : integer
     * @return mixed
     */
    public function addInterest($user,$slug){
       return  $user->userInterests()->attach($this->categories->where('slug',$slug)->get());
    }
      /**
     * Unfollows  a user
     *
     * @param 1 Object
     * @param 2 int
     */
    public function removeInterest($user,$slug){
     return  $user->userInterests()->detach($this->categories->where('slug',$slug)->get());
    }
}
?>