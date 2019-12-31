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
        $share =$this->share->where('blog_id',$blog->id)->latest();
        if(!$share){
            $this->share->create(array('blog_id'=>$blog->id,'fb_share_count'=>0,'tw_share_count'=>0,'ln_share_count'=>0));
        }
    	$shareByBlog=$this->share->where('blog_id',$blog->id)->first();
        // print_r($shareByBlog);exit;
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
    	$share=$this->share->where('blog_id',$blog->id)->first();
      if(!$share){
            $this->share->create(array('blog_id'=>$blog->id,'fb_share_count'=>0,'tw_share_count'=>0,'ln_share_count'=>0));
        }
        $shareByBlog=$this->share->where('blog_id',$blog->id)->first();
		$total = $shareByBlog->fb_share_count + $shareByBlog->tw_share_count + $shareByBlog->ln_share_count; 
		$data['total_share']=$total;
   	 return	$data;
    }
    public function incrementFbShare($blogCode){
    	$share= $this->getShareByCode($blogCode);
    	$share->increment('fb_share_count',1);
    	return true;
    }
     public function incrementTwShare($blogCode){
        $share= $this->getShareByCode($blogCode);
        $share->increment('tw_share_count',1);
        return true;
    }
}
?>