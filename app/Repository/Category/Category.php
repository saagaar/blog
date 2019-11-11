<?php 

namespace App\Repository\Category;

use App\Models\Categories;
use App\Repository\CategoryInterface;
Class Category implements CategoryInterface
{
	protected $cat;

	public function __construct(Categories $blogCat)
	{
		$this->cat=$blogCat;
	}

     
  public function getCatById($blogcat_id){
      return	$this->cat->where('id', $blogcat_id)->with('tags')->first();
    }
  /**
   * get category by slug
   */
  public function getCatBySlug($slug){
      return $this->cat->where('slug', $slug)->first();
    }
    /**
     * get tagsid by cat slug
     */
  public function getTagsIdByCatSlug($slug){
    $category = $this->cat->where('slug', $slug)->first();
    $tagsId = $category->tags()->select('tags_id')->get()->pluck('tags_id');

    return $tagsId;
      // return  $this->cat->where('slug', $slug)->first()->blogs()->withCount('likes','comments')->get();
    }
  public function getCategoryByShowInHome($limit=8){
    $data=$this->cat->orderByRaw('FIELD(priority,NULL) ASC')->limit($limit)->get();
    return $data;
  }
      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->cat->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){
      return	$this->cat->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
      return	$this->cat->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return	$this->cat->find($id)->delete();
    }
}
?>