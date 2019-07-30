<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController; 
use App\Repository\BlogInterface; 
use App\Repository\LocaleInterface;
// use App\Models\blogcategoriesegorys;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App;
class BlogController extends AdminController
{
    protected $blog;

    function __construct(BlogInterface $blog)
    {
        parent::__construct();
        $this->blog=$blog;
    }
    public function list()
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All Blogs',
                      ]];
        $blogs = $this->blog->getAll()->paginate($this->PerPage);
        return view('blog.listblog')->with(array('blogs'=>$blogs,'breadcrumb'=>$breadcrumb,'menu'=>'Blog List'));
    }
    public function create(Request $request,LocaleInterface $Locale)
    {
        $breadcrumb=['breadcrumbs'    => 
                    [
                      'Dashboard'     => route('admin.dashboard'),
                      'All Blogs' => route('blog.list'),
                      'current_menu'  =>'Create Blog',
                    ]];

        if ($request->method()=='POST') 
        {
            $requestobj=app(BlogRequest::class);
            $validatedData = $requestobj->validated();
            $this->blog->create($validatedData);
            return redirect()->route('blog.list')
                             ->with(array('success'=>'Blog created successfully.','breadcrumb'=>$breadcrumb));
        }
        $LocaleList=$Locale->getActiveLocale()->toArray();
        return view('blog.createblog')->with(array('breadcrumb'=>$breadcrumb,'localelist'=>$LocaleList));
    }
    public function edit(Request $request, $id,$slug,LocaleInterface $Locale)
    {
            $breadcrumb=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'All Blogs' => route('blog.list'),
                        'current_menu'=>'Edit Blog',
                          ]];
            $blog =$this->blog->GetBlogById($id);
            if ($request->method()=='POST') 
            {
                $requestobj=app(BlogRequest::class);
                $validatedData = $requestobj->validated();
                $this->blog->update($id,$validatedData);
                return redirect()->route('blog.list')
                            ->with('success','Blog Updated Successfully.');
            }
            $localelist=$Locale->getActiveLocale()->toArray();
            return view('blog.editblog',compact('blog','breadcrumb','localelist'));
    }
    public function delete($id)
    {
        // $category =$this->blog->getcatById($id);
        // $category->delete();
        // return redirect()->route('adminblogcategory.list')
        // ->with('success', 'Blog category has been deleted!!');
    }
}
