<?php 

namespace App\Repository\BlogVisit;

use App\Models\BlogVisits;
use App\Repository\BlogVisitInterface;

Class BlogVisit implements BlogVisitInterface
{
	protected $blogvisit;
	public function __construct(BlogVisits $member)
	{
		$this->blogvisit=$member;
	}
    public function getById($memberid){
      return $this->blogvisit->where('id', $memberid)->first();
    }

     /**
     * Get id in blogvisit.
     *
     * @return mixed
     */
    public function getAll(){
   	 return	$this->blogvisit->latest();
    }
    /**
     * blog count
     */
    public function getIpByBlog($blog,$ip){
        try
        {
            $blogIp = $this->blogvisit->where(['blog_id'=>$blog->id])->first();
            if($blogIp){
                $start = date("d",strtotime($blogIp->visit_date));
                $end = date("d",strtotime("Y-m-d H:i:s"));
                if($blogIp->ip_address==$ip){
                    if($start != $end){
                        $this->update($blogIp->id,
                            array(
                            'visit_date'            =>date("Y-m-d H:i:s"),
                        ));
                        return true;
                    }
                    else{
                        return false;
                    }
                }
                else{
                    $this->create(
                        array(
                        'blog_id'               =>$blog->id,
                        'ip_address'            =>$ip,
                        'visit_date'            =>date("Y-m-d H:i:s"),
                    ));
                    return true;
                }
            }else{
                $this->create(
                    array(
                    'blog_id'               =>$blog->id,
                    'ip_address'            =>$ip,
                    'visit_date'            =>date("Y-m-d H:i:s"),
                ));
                return true;
            }
        } catch (Exception $e) {

        }
    }
 	/**
     * create a post of blogvisit
     *
     * @return mixed
     */
    public function create(array $data){
      return $this->blogvisit->create($data);
    }
     /**
     * Updates a blogvisit's data.
     *
     * @param int
     * @param array
     */
    public function update( $id,array $data){
         return $this->blogvisit->find($id)->update($data);
    }
      /**
     * Delete a blogvisit's data.
     *
     * @param int
     */
    public function delete($id){
      return $this->blogvisit->find($id)->delete();
    }

}
?>