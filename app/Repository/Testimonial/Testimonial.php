<?php 

namespace App\Repository\testimonial;

use App\Models\Testimonials;
use App\Repository\TestimonialInterface;

Class Testimonial implements TestimonialInterface
{
	protected $member;
	public function __construct(Testimonials $member)
	{
		$this->testimonial=$member;
	}

     
    public function getById($memberid){
      return $this->testimonial->where('id', $memberid)->first();
    }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->testimonial->latest();
    }
 	
 	  /**
     * create a 
     *
     * @return mixed
     */
    public function create(array $data){
      return $this->testimonial->create($data);
    }
     /**
     * Updates a post.
     *
     * @param int
     * @param array
     */

    public function update( $id,array $data){
         return $this->testimonial->find($id)->update($data);
    }

      /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id){
      return $this->testimonial->find($id)->delete();
    }
}
?>