<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController; 
use App\Repository\TestimonialInterface;
use Illuminate\Http\Request;
use App\Http\Requests\TestimonialRequest;
use Illuminate\Support\Facades\File;
use App;

class TestimonialController extends AdminController
{
     protected $testimony;

    function __construct(TestimonialInterface $testimony)
    {
         parent::__construct();
         $this->testimony=$testimony;
    }



     public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All Blogs',
                      ]];
        $search = $request->get('search');
        if($search){
            $blogs = $this->testimony->getAll()->where('title', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $blogs = $this->testimony->getAll()->paginate($this->PerPage);
        }
        return view('blog.listblog')->with(array('testimony'=>$blogs,'breadcrumb'=>$breadcrumb,'menu'=>'Blog List'));
    }

}
