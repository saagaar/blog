<?php 

namespace App\Repository\Blog;

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
    return $this->blog->where(['save_method'=>2])->orderBy('created_at','DESC')->withCount('likes')->limit(3)->get();
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