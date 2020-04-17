<?php 

namespace App\Repository\Account;

use App\Models\Users;
use Spatie\Permission\Traits\HasRoles;
use App\Repository\AccountInterface;

Class Account implements AccountInterface
{
	protected $user;
    use HasRoles;

	public function __construct(Users $user)
	{
		$this->account=$user;
    
	}
     
    public function getById($memberId){
      return $this->account->where('id', $memberId)->first();
    }
    public function getByUserId($memberId){
      return $this->account->where('id', $memberId)->withCount('followers','followings')->first();
    }
    public function countAllTodayLoggedInUsers()
    {
      return $this->account->whereDate('last_login_date','=',date('Y-m-d'))->count();
    }

    public function countAllUsers(){
      return $this->account->get()->count();    
    }

    public function countAllTodaysRegisteredUsers(){
         return $this->account->whereDate('created_at','=',date('Y-m-d'))->count();   
     }

    public function countActiveUsers(){
        return $this->account->where('status','=','1')->count();   
     }
    public function countInActiveUsers(){
        return $this->account->where('is_login','=','2')->count();   
     }
    
    public function getUserByUsername($username){
      return $this->account->where('username', $username)->withCount('followers','followings')->first();
    }

    public function getActiveAccounts(){
     return $this->account->where('status','1')->get();
    }
    public function insertIp($username,$ip){
      $user = $this->account->where('username', $username)->first();
      $ipcheck = $user->usersIpaddress()->where('ip_address',$ip)->get()->toArray();
      if($ipcheck){
        return false;
      }else{
        $ipad=  array('ip_address'=>$ip);
        return $user->usersIpaddress()->create($ipad);
      }
    }

    public function getAllUserWithBlogCount(){
      return $this->account->withCount('published_blogs')->latest();
    }
      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	  return $this->account->latest();
    }
 	
 	  /**
     * 
     *
     * @return mixed
     */
    public function create(array $data){
      return $this->account->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
      return $this->account->find($id)->update($data);
    }
      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return $this->account->find($id)->delete();
    }

    public function getUsersNotification($user,$limit=10,$offset=0){
        return $user->unreadNotifications()->orderBy('id','DESC')->union($user->readNotifications())->limit($limit)->offset($offset)->get();
    }



    public function markNotificationsToRead($notifications){
        return $notifications->markAsRead();
    }
    public function countUnreadNotifications($user){
        return $user->unreadNotifications()->count();
    }
}
?>