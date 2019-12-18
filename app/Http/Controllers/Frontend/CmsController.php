<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use Validator,Redirect,Response,File;
use Image;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repository\CmsInterface;
use App\Repository\CategoryInterface;

class CmsController extends FrontendController
{
	protected $cms;
    use AuthorizesRequests;

    function __construct(CmsInterface $cms,CategoryInterface $category)
    {
        parent::__construct();
        $this->cms=$cms;
        $this->category=$category;
    }
    public function cmsPage($slug)
    {
    	$cms_data = $this->cms->getCmsBySlug($slug);
        $user ='';
        $data['path']='/page/';
        // echo "<pre>";
        //  print_r($cms_data);exit;
        if($cms_data){
            if(\Auth::check())
            {
               $routeName= ROUTE::currentRouteName();
              if($routeName=='api')
              {
                return ($data);
              }
              else
              {
                  $data['path']='/page';
                  $initialState=json_encode($data);
                  $user=$this->user_state_info();
              }
            }
        	$navCategory=$this->category->getCategoryByShowInHome();
        	return view('frontend.home.cms',['initialState'=>$data,'user'=>$user])->with(array('cms'=>$cms_data,'navCategory'=>$navCategory));
        }else {
            abort(404);
        }
    }
    public function contactUs(Request $request)
    {
      
         $data=array();
        $navCategory=$this->category->getCategoryByShowInHome();
        $user ='';
        $data['path']='/contact-us';
         if(\Auth::check())
        {
           $routeName= ROUTE::currentRouteName();
          if($routeName=='api')
          {
            return ($data);
          }
          else
          {
              $data['path']='/contact-us';
              $initialState=json_encode($data);
              $user=$this->user_state_info();
          }
        }

        
        return view('frontend.home.contact',['initialState'=>$data,'user'=>$user])->with(array('navCategory'=>$navCategory));
    }
}
