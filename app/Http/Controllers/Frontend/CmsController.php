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
    	$navCategory=$this->category->getCategoryByShowInHome();
    	return view('frontend.home.cms')->with(array('cms'=>$cms_data,'navCategory'=>$navCategory));
    }
}
