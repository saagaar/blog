<?php 
namespace App\Repository\Blog;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blogs;
use App\Repository\BlogInterface;
Class Blog implements BlogInterface
{
	protected $blog;
	public function __construct(Blogs $blog)
	{
		$this->blog=$blog;
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
   * get blog by category
   */
  public function getBlogByCategory($tagsIds,$limit=10,$offset=0){
    $blogByCategoryTags =$this->blog->whereHas('tags', function ($q) use ($tagsIds) {
    return $q->whereIn('tags_id', $tagsIds); 
    })
    ->withCount('likes','comments')->take($limit)->skip($offset)->get();
   
    return $blogByCategoryTags;
  }


  public function getBlogCountByCategory($tagsIds,$limit=10,$offset=0){
    $blogsCount =$this->blog->whereHas('tags', function ($q) use ($tagsIds) {
    return $q->whereIn('tags_id', $tagsIds); 
    })->count();
    return $blogsCount;
  }

  /**
   * get blog for featured =1
   */
  public function getLikesOfBlogByUser($user){
    return $this->blog->likes('id:user_id')->get();
  }

  public function getAllFeaturedBlog($limit=10,$offset=0){
    return $this->blog->where(['featured'=> 1,'save_method'=>2])->with('tags')->withCount('likes','comments')->take($limit)->skip($offset)->get();
  }
  public function getAllFeaturedForMember($limit=10,$offset=0){
    return $this->blog->where(['featured'=> 1,'save_method'=>2])->with('tags')->withCount('likes','comments')->take($limit)->skip($offset)->get();
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
  public function getLatestAllBlog($limit=10,$offset=0){
    return $this->blog->where(['save_method'=>2])->orderBy('created_at','DESC')->withCount('likes','comments')->take($limit)->skip($offset)->get();
  }

  public function getPopularBlog($limit=10,$offset=0){
    return $this->blog->where(['save_method'=>2])->orderBy('likes_count','DESC')->withCount('likes','comments')->take($limit)->skip($offset)->get();
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
    return  $this->blog::with('user:id,username')->withCount('likes','comments')->where('user_id', $userid)->orderByDesc('id');
  }

  public function countAllBlogUser(){
     return $this->blog->get()->count();
  }

  public function countPublishedBlog(){
     return $this->blog->where('save_method','=' ,'2')->count();
  }

  public function countSavedBlog(){
     return $this->blog->where('save_method','=' ,'1')->count();
  }
   
  public function countPublishedBlogsThisMonth(){
     return $this->blog->whereMonth('created_at','=',date('m'))->where('save_method','=','2')->count();
  }

  public function countTodaysPublishedBlogs(){
     return $this->blog->whereDate('created_at','=',date('Y-m-d'))->where('save_method','=','2')->count();
  }
  
  public function getActiveBlogByUserId($userid){
    return  $this->blog::with('user:id,username')->where(['user_id'=>$userid,'save_method'=>'2'])->withCount('likes','comments')->orderByDesc('id');
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

  public function updateBlogViewCount($blog){
    $blog->increment('views',1);
  }
}
?>