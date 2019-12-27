<?php 

namespace App\Repository\UserInteraction;

use App\Models\Comments;
use App\Repository\UserInteractionInterface;
use App\Models\Blogs;
Class  UserInteraction implements UserInteractionInterface
{
	protected $comment;
    protected $blog;
	public function __construct(Comments $comment,Blogs $blog)
	{
		$this->comment=$comment;
        $this->blog=$blog;
	}

    /**
     * check if current user $user_id is following following_id
     *
     * @return boolean
     */
    /**
     * check if current user $user_id is following username
     *
     * @return boolean
     */
    public function createCommment($data){
        return $this->comment->create($data);
    }
    public function getCommentByBlogId($id){
        return $this->comment->where('blog_id',$id)->with('user:id,name,username,image')->get();
    }
       /**
     * Get's all follow lists.
     *
     * @param int
     * @return mixed
     */
    public function isLiked($user,$code){
      return $user->likes()->where('code',$code)->get();
    }
     public function getLikeByBlog($code){
        return $this->blog->where('code',$code)->withCount('likes')->get();
     }

    public function getAuthorByBlog($code){
        return $this->blog->where('code',$code)->with('user')->first();
     }
    public function likeBlog($user,$code){
        // print_r($this->blog->where('code',$code)->get());exit;
       return  $user->likes()->attach($this->blog->where('code',$code)->get());
    }
      /**
     * Unfollows  a user
     *
     * @param 1 Object
     * @param 2 int
     */
    public function unlikeBlog($user,$code){
     return  $user->likes()->detach($this->blog->where('code',$code)->get());
    }
    public function getSaveByBlog($code){
        return $this->blog->where('code',$code)->withCount('save_blogs')->get();
     }
    public function saveBlog($user,$code)
    {
        return  $user->save_blogs()->attach($this->blog->where('code',$code)->first());
    }
    public function unsaveBlog($user,$code)
    {
        return  $user->save_blogs()->detach($this->blog->where('code',$code)->first());
    }
    public function isSaved($user,$code){
      $blogIds =  $user->saved_blogs()->pluck('blog_id');
      $saved = $this->blog->whereIn('id', $blogIds)->get()->pluck('code')->toArray();
      if(in_array($code, $saved)){
        return true;
      }else{
        return false;
      }
    }
}
?>