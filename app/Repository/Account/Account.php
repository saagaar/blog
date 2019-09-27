<?php 

namespace App\Repository\Account;

use App\Models\User;
use Spatie\Permission\Traits\HasRoles;
use App\Repository\AccountInterface;

Class Account implements AccountInterface
{
	protected $user;
    use HasRoles;
	public function __construct(User $user)
	{
		$this->account=$user;
	}
     
    public function getById($memberId){
      return $this->account->where('id', $memberId)->first();
    }

    public function getUserByUsername($username){
      return $this->account->where('username', $username)->first();
    }

    public function getActiveAccounts(){
     return $this->account->where('status',1)->get();
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

    // public function getBlogsByUser($username)
    // {
    //     echo '<pre>';
    //     $data=$this->account->where('username',$username)->first()->toArray();
    //       $comments = Comment::where('post_id', $postId)->with('user')->paginate(15);
    //     print_r($data);
    //   return $data;
    // }
}
?>