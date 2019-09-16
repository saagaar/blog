<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\BlogInterface; 
use App\Repository\LocaleInterface;
use App\Repository\TagInterface;
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
        return view('admin.blog.listblog')->with(array('blogs'=>$blogs,'breadcrumb'=>$breadcrumb,'menu'=>'Blog List'));
    }
    public function create(Request $request,LocaleInterface $Locale,TagInterface $tag)
    {
        $breadcrumb=['breadcrumbs'    => 
                    [
                      'Dashboard'     => route('admin.dashboard'),
                      'All Blogs' => route('blog.list'),
                      'current_menu'  =>'Create Blog',
                    ]];
        $taglist = $tag->getAll()->get();
        if ($request->method()=='POST') 
        {
            $requestobj=app(BlogRequest::class);
            $validatedData = $requestobj->validated();
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('frontend/images/blog'), $imageName);
            $validatedData['image'] = $imageName;
            $created = $this->blog->create($validatedData);
            $created->tags()->attach($validatedData['tags']);
            return redirect()->route('blog.list')
                             ->with(array('success'=>'Blog created successfully.','breadcrumb'=>$breadcrumb));
        }
        $LocaleList=$Locale->getActiveLocale()->toArray();
        return view('admin.blog.createblog')->with(array('breadcrumb'=>$breadcrumb,'tags'=>$taglist,'localelist'=>$LocaleList));
    }
    public function edit(Request $request, $id,$slug,LocaleInterface $Locale,TagInterface $tag)
    {
            $breadcrumb=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'All Blogs' => route('blog.list'),
                        'current_menu'=>'Edit Blog',
                          ]];
                          $taglist = $tag->getAll()->get();

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
                    request()->image->move(public_path('frontend/images/blog'), $imageName);
                    $validatedData['image'] = $imageName;
                }else {
                    $validatedData['image'] = $blog->image;
                }
                // dd($validatedData);
                $updated = $this->blog->update($id,$validatedData);
                $blog->tags()->sync($validatedData['tags']);
                return redirect()->route('blog.list')
                            ->with('success','Blog Updated Successfully.');
            }
            $localelist=$Locale->getActiveLocale()->toArray();
            return view('admin.blog.editblog')->with(array('blog'=>$blog,'tags'=>$taglist,'breadcrumb'=>$breadcrumb,'localelist'=>$localelist));
    }
    public function delete($id)
    {
       $blog =$this->blog->GetBlogById($id);

        if( $blog){
            $dir = 'frontend/images/blog';
            if ($blog->image != '' && File::exists($dir . $blog->image)){
                File::delete($dir . $blog->image);
            }
            $blog->delete();
        }
        return redirect()->route('blog.list')
        ->with('success', 'Blog has been deleted!!');
    }
}
