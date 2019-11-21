<?php 
namespace App\Repository;

interface ShareInterface
{
	 /**
     * Get's a post by it's ID
     *
     * @param int
     */
    public function getShareByCode($blog_code);
      
      /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getTotalShare($blog_code);
}