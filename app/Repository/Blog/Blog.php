<?php 
namespace App\Repository\Blog;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blogs;
use App\Repository\BlogInterface;
use Carbon\Carbon;
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
    ->where(['save_method'=>2,'show_in_home'=>1])->with('user')->withCount('likes','comments')->orderBy('created_at','DESC')->take($limit)->skip($offset)->get();
   
    return $blogByCategoryTags;
  }


  public function getBlogCountByCategory($tagsIds,$limit=10,$offset=0){
    $blogsCount =$this->blog->whereHas('tags', function ($q) use ($tagsIds) {
    return $q->whereIn('tags_id', $tagsIds); 
    })->count();
    return $blogsCount;
  }
  public function getSaveBlogByUser($user){
    return $user->saved_blogs()->pluck('blog_id');
  }
  public function getBlogCodeBySave($blogIds)
  {
    return $this->blog->whereIn('id', $blogIds)->get()->pluck('code');
  }
  public function getSavedBlog($blogIds,$limit=10,$offset=0)
  {
    return $this->blog->whereIn('id', $blogIds)->withCount('likes','comments')->with('user')->take($limit)->skip($offset)->get();
  }
  
  public function getLikesOfBlogByUser($user,$blogcode=false){
    return $user->likes()->pluck('code');
  }

   public function doUserLikesBlog($user,$blogcode=false){
    return $user->likes()->where('code',$blogcode)->pluck('code');
  }
  public function getBlogCodeByLike($blogIds)
  {
    return $this->blog->whereIn('id', $blogIds)->get()->pluck('code');
  }
  public function getAllFeaturedBlog($limit=10,$offset=0){
    return $this->blog->where(['featured'=> 1,'save_method'=>2,'show_in_home'=>1])->orderBy('created_at','DESC')->with('tags')->withCount('likes','comments')->take($limit)->skip($offset)->get();
  }
  public function getAllFeaturedForMember($limit=10,$offset=0){
    return $this->blog->where(['featured'=> 1,'save_method'=>2,'show_in_home'=>1])->orderBy('created_at','DESC')->with('tags')->withCount('likes','comments')->take($limit)->skip($offset)->get();
  }
   /**
   * get blog for most view
   */
  public function getAllBlogByViews(){
    return $this->blog->where(['save_method'=>2,'show_in_home'=>1])->orderBy('views','DESC')->limit(3)->get();
  }
   /**
   * get latest blog 
   */
  public function getLatestAllBlog($limit=10,$offset=0){
    return $this->blog::with('user:id,username')->where(['save_method'=>2,'show_in_home'=>1])->orderBy('created_at','DESC')->with('user','likes')->withCount('likes','comments')->take($limit)->skip($offset)->get();
  }

  public function getPopularBlog($limit=10,$offset=0){
    return $this->blog::with('user:id,username')->where(['save_method'=>2,'show_in_home'=>1])->orderBy('likes_count','DESC')->withCount('likes','comments')->take($limit)->skip($offset)->get();
  }
  /**
   * get blog bye following
   */
  public function getBlogOfFollowingUser($user,$limit=10,$offset=0){
    $listofFollowings=$user->followings()->select('follow_id')->get()->pluck('follow_id')->toArray();
    return $this->blog->where(['save_method'=>2,'show_in_home'=>1])->whereIn('user_id', $listofFollowings)->with('user')->orderBy('created_at','DESC')->withCount('likes','comments')->latest()->take($limit)->skip($offset)->get()->toArray();
  }
  public function getBlogOfFollowingUserDaily($user,$limit=10,$offset=0){
    $listofFollowings=$user->followings()->select('follow_id')->get()->pluck('follow_id')->toArray();
    $today = Carbon::today()->toDateString();
    return $this->blog->where(['save_method'=>2,'show_in_home'=>1])->whereDate('created_at','=',$today)->whereIn('user_id', $listofFollowings)->with('user')->orderBy('created_at','DESC')->withCount('likes')->latest()->take($limit)->skip($offset)->get()->toArray();
  }
  /**
   * get retaled blog
   */
  public function relatedBlogBycode($blogCode,$limit=5){
    $blogData=$this->blog->where('code', $blogCode)->first();
    $related =$this->blog->whereHas('tags', function ($q) use ($blogData) {
      $q->whereIn('name', $blogData->tags()->pluck('name')); 
    })
    ->where('id', '!=', $blogData->id)
    ->where('save_method','2')
    ->orderBy('created_at','DESC')->limit($limit) // So you won't fetch same post
    ->get();
    return $related;
  }
  /**
   * get blog by  blog code
   */
  public function getBlogByCode($blogCode){
    return $this->blog->where('code', $blogCode)->with('tags','user')->withCount('likes','comments')->first();
  }
  public function getActiveBlogByCode($blogCode){
    return $this->blog->where(['save_method'=>2,'code'=>$blogCode])->with('tags','user')->withCount('likes','comments')->first();
  }

  public function getPublishedBlogCountByUser($userid){
    return $this->blog->where(['save_method'=>2,'user_id'=>$userid])->count();
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

  public function getAllBlogsWithUser(){
   return $this->blog::with('user:id,username,name')->latest();
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