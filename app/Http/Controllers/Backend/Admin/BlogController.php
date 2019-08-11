<?php

namespace App\Http\Controllers\Backend\Admin;
use App\Http\Controllers\Backend\Admin\AdminController; 
use App\Repository\BlogInterface; 
use App\Repository\LocaleInterface;
// use App\Models\blogcategoriesegorys;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\File;
use App;
class BlogController extends AdminController
{
    protected $blog;

    function __construct(BlogInterface $blog)
    {
        parent::__construct();
        $this->blog=$blog;
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All Blogs',
                      ]];
        $search = $request->get('search');
        if($search){
            $blogs = $this->blog->getAll()->where('title', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $blogs = $this->blog->getAll()->paginate($this->PerPage);
        }
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
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images/blogimages'), $imageName);
            $validatedData['image'] = $imageName;
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
                if ($request->hasFile('image')) {
                    $dir = 'images/blogimages/';
                    if ($blog->image != '' && File::exists($dir . $blog->image))
                    File::delete($dir . $blog->image);

                    $imageName = time().'.'.request()->image->getClientOriginalExtension();
                    request()->image->move(public_path('images/blogimages'), $imageName);
                    $validatedData['image'] = $imageName;
                }else {
                    $validatedData['image'] = $blog->image;
                }
                $blog->update($validatedData);
                return redirect()->route('blog.list')
                            ->with('success','Blog Updated Successfully.');
            }
            $localelist=$Locale->getActiveLocale()->toArray();
            return view('blog.editblog',compact('blog','breadcrumb','localelist'));
    }
    public function delete($id)
    {
       $blog =$this->blog->GetBlogById($id);

        $result = $blog->delete();
        if($result=='true'){
            $dir = 'images/blogimages/';
            if ($blog->image != '' && File::exists($dir . $blog->image)){
                File::delete($dir . $blog->image);
            }
        }
        return redirect()->route('blog.list')
        ->with('success', 'Blog has been deleted!!');
    }
}
