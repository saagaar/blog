<?php 

namespace App\Repository\Tag;

use App\Models\Tags;
use App\Repository\TagInterface;

Class Tag implements TagInterface
{
	protected $tag;
	public function __construct(Tags $tags)
	{
		$this->tag=$tags;
	}

     
    public function getTagById($tagsid){
      return $this->tag->where('id', $tagsid)->first();
    }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->tag->latest();
    }
 	/**
     * Get tag by name 
     * @return id
     */
    public function getTagByName($tags){
      return $this->tag->whereIn('name',$tags)->select('id')->get();
    }

    public function getTagsList(){
      return $this->tag->where('status','1')->select('name')->get()->toArray();
    }
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){
      return $this->tag->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
         return $this->tag->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return $this->tag->find($id)->delete();
    }


    public function getTag($search)
    {
         return $this->tag->where('name', 'like', '%' . $search . '%')->get()->toArray();
    }
}
?>