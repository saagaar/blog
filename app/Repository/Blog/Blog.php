<?php 

namespace App\Repository\Blog;

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
   * Get  Blog by user id
   *
   * @param int
   */
  public function getBlogByUserId($user){
    return  $this->blog->where('id', $blogId)->first();
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

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return	$this->blog->find($id)->delete();
    }
}
?>