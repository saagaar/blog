<?php 

namespace App\Repository\Blog;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blogs;
use App\Repository\BlogInterface;
use App\Repository\TagInterface;
Class Blog implements BlogInterface
{
	protected $blog;
  protected $tag;
	public function __construct(Blogs $blog,TagInterface $tag)
	{
		$this->blog=$blog;
    $this->tag=$tag;
	}

  /**
   * Get  Blog by id
   *
   * @param int
   */
  public function getBlogById($blogId){
    return  $this->blog->where('id', $blogId)->first();
  }

  /**
   * get blog for featured =1
   */

  public function getAllFeaturedBlog(){
    return $this->blog->where(['featured'=> 1,'save_method'=>2])->with('tags')->limit(4)->get();
  }
  public function getAllFeaturedForMember(){
    return $this->blog->where(['featured'=> 1,'save_method'=>2])->with('tags')->withCount('likes')->limit(5)->get();
  }

   /**
   * get blog for most view
   */
  public function getAllBlogByViews(){
    return $this->blog->where(['save_method'=>2])->orderBy('views','DESC')->limit(3)->get();
  }
   /**
   * get latest blog 
   */
  public function getLatestAllBlog(){
    return $this->blog->where(['save_method'=>2])->orderBy('created_at','DESC')->withCount('likes','comments')->limit(3)->get();
  }
  public function getPopularBlog(){
    return $this->blog->where(['save_method'=>2])->orderBy('likes_count','DESC')->withCount('likes','comments')->limit(3)->get();
  }
  /**
   * get blog bye following
   */
  public function getBlogOfFollowingUser($user){
    $listofFollowings=$user->followings()->select('follow_id')->get()->pluck('follow_id')->toArray();
    return $this->blog->whereIn('user_id', $listofFollowings)->latest()->get()->toArray();
  }

  /**
   * get retaled blog
   */
  public function relatedBlogBycode($blogCode){
    $blogData=$this->blog->where('code', $blogCode)->first();
    $related =$this->blog->whereHas('tags', function ($q) use ($blogData) {
    return $q->whereIn('name', $blogData->tags()->pluck('name')); 
    })
    ->where('id', '!=', $blogData->id) // So you won't fetch same post
    ->get();
    return $related;
  }
  /**
   * get blog by  blog code
   */
  public function getBlogByCode($blogCode){
    return $this->blog->where('code', $blogCode)->with('tags','user')->withCount('likes','comments')->first();
  }
   /**
   * Get  Blog by user id
   *
   * @param int
   */
  public function getBlogByUserId($userid){
    return  $this->blog::with('user:id,username')->where('user_id', $userid)->orderByDesc('id');
  }
  
  public function getActiveBlogByUserId($userid){
    return  $this->blog::with('user:id,username')->where(['user_id'=>$userid,'save_method'=>'2'])->orderByDesc('id');
  } 
     
  public function getAssociatedCategoryOfBlog($blogId){
      return	$this->blog->where('id', $blogId)->first();
  }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->blog->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){
      return	$this->blog->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
      return	$this->blog->find($id)->update($data);
    }
    public function updateByCode( $code,array $data){
      return $this->blog->where('code', $code)->update($data);
    }
      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return	$this->blog->find($id)->delete();
    }
    public function addTag($postId,$tags){
      $blogData = $this->blog->where('code',$postId)->first();
      return $blogData->tags()->sync($tags);
    }
}
?>