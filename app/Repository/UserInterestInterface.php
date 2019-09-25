<?php 
namespace App\Repository;

interface UserInterestInterface
{
	 /**
     * check if user has category in interest by category id
     *
     * @param 1 int
     * @param 2 int
     */
    public function isInterest($userid,$categoryid);

      /**
     * check if user has category in interest by slug
     *
     * @param int
     * @return mixed
     */
      public function isAddedBySlug($userid,$slug);
   /**
    * Get All User Interests
    */
     public function getAllInterests($userid);
 	
 	  /**
     * add user interest
     * @param int
     * @return boolean
     */
    public function addInterest($userid,$categoryid);

      /**
     * remove a user interest.
     *
     * @param int
     * @return boolean
     */
    public function removeInterest($userid,$categoryid);

    
}