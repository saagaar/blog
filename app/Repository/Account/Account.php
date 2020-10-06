<?php 

namespace App\Repository\Account;

use App\Models\Users;
use Spatie\Permission\Traits\HasRoles;
use App\Repository\AccountInterface;
use DB;
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
       return $user->Notifications()->orderBy('created_at','DESC')->limit($limit)->offset($offset)->get();
    }
    public function pointIncrement($id,$point){
      return $this->account->find($id)->increment('point',$point);
    }
    public function pointDecrement($id,$point){
        return $this->account->find($id)->whereRaw("(point-point_previous)>$point")->decrement('point',$point);
    }
    public function markNotificationsToRead($notifications){
        // return $notifications->markAsRead();
    }
    public function countUnreadNotifications($user){
        // return $user->unreadNotifications()->count();
    }
    public function getTotalCurrentPoint(){
    return  $this->account->selectRaw(('sum(point-point_previous) as sum'))->where('status','1')->first();
    }

    public function processPointForEarning($pointWeightage){
      return $this->account
        ->where('status','1')
        ->update([
            'amount'  =>  DB::raw("amount+((point-point_previous)*$pointWeightage)"),
            'point_previous'=>DB::raw("point"),
            'point_collection'=>json_encode([
                                  'current_point'=>DB::raw("point"),
                                  'current_amount'=>DB::raw("amount")+DB::raw("(point-point_previous)*$pointWeightage)"),
                                  'sharing_amount'=>config('settings.sharing_amount'),
                                  'total_points'=>$this->getTotalCurrentPoint()->sum,
                                  'date'=>date('Y-m-d')
                                ])
        ]);
    }

    public function getUserTransaction(){
      return $this->account->transaction();
    }

    public function increaseWalletBalance($id,$amount){
        return $this->account
        ->where('id',$id)
        ->update([
            'amount'  =>  DB::raw("amount+$amount"),
        ]);
    }
     public function decreaseWalletBalance($id,$amount){
        return $this->account
        ->where('id',$id)
        ->update([
            'amount'  =>  DB::raw("amount-$amount"),
            'paid_amount'=>DB::raw("paid_amount+$amount")
        ]);
    }
}
?>