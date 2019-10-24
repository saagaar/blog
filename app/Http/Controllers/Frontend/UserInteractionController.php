<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Repository\TagInterface;
use Validator,Redirect,Response,File;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repository\BlogInterface;
use App\Repository\UserInteractionInterface;  
class UserInteractionController extends FrontendController
{
    protected $data;
	protected $userInteraction;

    use AuthorizesRequests;

    function __construct(UserInteractionInterface $userInteraction)
    {
        parent::__construct();
        $this->userInteraction=$userInteraction;
    }
    public function likeBlog($code)
    {
        
        $isLiked=$this->userInteraction->isLiked($this->authUser,$code)->toArray();
        // print_r($isLiked);exit;
         if(empty($isLiked))
         {
            $this->userInteraction->likeBlog($this->authUser,$code);
         }else{
         	$this->userInteraction->unlikeBlog($this->authUser,$code);
         }
         return array('status'=>true,'message'=>'success');
    }
    
    public function likeCount($code){
    	return $this->userInteraction->getLikeByBlog($code);
    }
    public function createComment(Request $request,$code,BlogInterface $blog){
        if($code){
            $request->validate([
            'comment' => 'required',
            ]);
            $input = $request->all();
            $date =date_create();
            $input['user_id']  =Auth()->user()->id;
            $blogData = $blog->getBlogByCode($code);
            $input['blog_id'] = $blogData->id;
            $input['created_at'] = $date->format('Y-m-d H:i:s');
            $this->userInteraction->createCommment($input);
             return array('status'=>true,'message'=>'success','data'=>array('comment'=>$input['comment'],'created_at'=>$input['created_at']));
        }
    }
    public function testinglike(){
    	// $lik = $this->likeCount('5da9637080085a4c');
    	// $lik = $this->likeBlog('5da98000180e5ed1');
    	print_r($lik);
    }
}
