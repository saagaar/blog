<?php 

namespace App\Repository\Share;

use App\Models\Shares;
use App\Repository\ShareInterface;
use App\Repository\BlogInterface;

Class Share implements ShareInterface
{
	protected $share;

	public function __construct(Shares $share)
	{
		$this->share=$share;
	}

    public function getShareByCode($blogCode){
      $this->blog =app()->make('App\Repository\BlogInterface');
    	$blog=$this->blog->getBlogByCode($blogCode);
    	$shareByBlog=$this->share->where('blog_id',$blog->id)->first();
    	return $shareByBlog;
    }

      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getTotalShare($blogCode){
    	$data=[];
    	$this->blog =app()->make('App\Repository\BlogInterface');
    	$blog=$this->blog->getBlogByCode($blogCode);
    	$shareByBlog=$this->share->where('blog_id',$blog->id)->first()->toArray();
		$total = $shareByBlog['fb_share_count'] + $shareByBlog['tw_share_count'] + $shareByBlog['ln_share_count']; 
		$data['total_share']=$total;
   	 return	$data;
    }
    public function incrementFbShare($blogCode){
    	$share= $this->getShareByCode($blogCode);
    	$share->increment('fb_share_count',1);
    	return true;
    }
}
?>