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
  public function GetBlogById($blogid){
    return  $this->blog->where('id', $blogid)->first();
  }
     
  public function GetAssociatedCategoryOfBlog($bloid){
      return	$this->blog->where('id', $bloid)->first();
  }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function GetAll(){
   	 return	$this->blog->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function Create(array $data){
      return	$this->blog->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function Update( $id,array $data){
      return	$this->blog->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function Delete($id){
      return	$this->blog->find($id)->delete();
    }
}
?>