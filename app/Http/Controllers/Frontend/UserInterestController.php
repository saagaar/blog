<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Repository\CategoryInterface;
use App\Repository\UserInterestInterface; 
class UserInterestController extends FrontendController
{
    protected $userInterest;
    protected $category;
     function __construct(UserInterestInterface $userInterest,CategoryInterface $category)
    {
         parent::__construct();
         $this->userInterest=$userInterest;
         $this->category=$category;
    }
    public function categories()
    {
        if(\Auth::check())
        {
            $routeName= Route::currentRouteName();
            if($routeName=='api')
            {
             
            $data['allCategories'] = $this->category->getAll()->where('parent_id', NULL)->with('categories')->get()->toArray();
            $data['userInterest'] = $this->getUserInterest();
            $data['path']='/categories';
              return ($data);
           }
           else
           {
            $data['allCategories'] = $this->category->getAll()->where('parent_id', NULL)->with('categories')->get()->toArray();
            $data['userInterest'] = $this->getUserInterest();
            $user=$this->user_state_info();
            $data['path']='/categories';
            $initialState=json_encode($data);
            return view('frontend.layouts.dashboard',['initialState'=>$data,'user'=>$user]);
            }

        }
        else
             return redirect()->route('home'); 
    }
   public function addUserInterest($slug)
    {
        
        $isInterest=$this->userInterest->isAddedBySlug($this->authUser,$slug)->toArray();
         if(!($isInterest))
         {
            $this->userInterest->addInterest($this->authUser,$slug);
         }  
         return array('status'=>true,'message'=>'success');
    }
    public function removeUserInterest($slug)
    {
        $isInterests=$this->userInterest->isAddedBySlug($this->authUser,$slug)->toArray();
         if(($isInterests))
         {
            $this->userInterest->removeInterest($this->authUser,$slug);
         }  
        return array('status'=>true,'message'=>'');
    }
    public function getUserInterest()
    {
        if ($this->authUser) {
            return $this->userInterest->getUserInterestsSlug($this->authUser)->pluck('slug');
        }else
            return array('status'=>false,'message'=>'No Interest Found');
    }
        
    public function testinterest()
    {
        print_r($this->addUserInterest('pubg'));
    }
}
