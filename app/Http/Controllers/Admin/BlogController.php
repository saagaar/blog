<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\BlogInterface; 
use App\Repository\LocaleInterface;
use App\Repository\TagInterface;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\File;
 // use Intervention\Image\Facades\Image;
 use Image;
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
        return view('admin.blog.listblog')->with(array('blogs'=>$blogs,'breadcrumb'=>$breadcrumb,'menu'=>'Blog List','primary_menu'=>'blog.list'));
    }
    public function create(Request $request,LocaleInterface $locale,TagInterface $tag)
    {
        $breadcrumb=['breadcrumbs'    => 
                    [
                      'Dashboard'     => route('admin.dashboard'),
                      'All Blogs' => route('blog.list'),
                      'current_menu'  =>'Create Blog',
                    ]];
    $tagList = $tag->getAll()->get();
    if ($request->method()=='POST') 
    {
         $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);  
        $requestObj=app(BlogRequest::class);
        $validatedData = $requestObj->validated();
        

        
        $validatedData['user_id'] = Auth()->user()->id;
        $created = $this->blog->create($validatedData); 
        $code= uniqid();
        $part1=substr($code,0, 7).str_pad($created->id,4,0,STR_PAD_BOTH);
        $part2=substr($code, 7,-1);
        $created['code']= $part1.$part2;
        $created->save();
        $created->tags()->attach($validatedData['tags']);
        
        $extension = request()->image->getClientOriginalExtension();
        // echo $extension;exit;
        $imageName = time().'.'.$extension;              
        $folder=public_path(). '/uploads/blog/'.$created['code'];
        if(!is_dir($folder))
            File::makeDirectory($folder, 0755, true);

        $tmpImg = request()->image->move($folder,$imageName);
         // echo $tmpImg;exit;
         // File::copy($tmp_img,$folder.'/thumbnail.jpeg');
                       
           $img = Image::make($tmpImg);          
           $img->resize(100, null, function ($constraint) 
           {
            $constraint->aspectRatio();
             })->save($folder.'/'.time().'-thumbnail.'.$extension);
           $data['image'] = $imageName;
           $this->blog->update($created->id,$data);
        return redirect()->route('blog.list')
                         ->with(array('success'=>'Blog created successfully.','breadcrumb'=>$breadcrumb));
    }
    
    $localeList=$locale->getActiveLocale()->toArray();
    return view('admin.blog.createblog')->with(array('breadcrumb'=>$breadcrumb,'tags'=>$tagList,'localelist'=>$localeList,'primary_menu'=>'blog.list'));

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
                 $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);  
                $requestObj=app(BlogRequest::class);
                $validatedData = $requestObj->validated();          

                if ($request->hasFile('image')) 
                {
                    $extension = request()->image->getClientOriginalExtension();
                    $imageName = time().'.'.$extension;              
                    $folder=public_path(). '/images/users-upload/blog/'.$blog->code.'/';
                    $tmpImg =request()->image->move($folder,$imageName);
                    $img = Image::make($tmpImg);         
                   $img->resize(100, null, function ($constraint) 
                   {
                     $constraint->aspectRatio();
                    }
                    )->save($folder.'/'.time().'-thumbnail.'.$extension);

                    if ($blog->image != '' && File::exists($folder . $blog->image))
                    {
                     File::delete($folder . $blog->image);
                    }
                    $validatedData['image'] = $imageName;
                }
                else 
                {
                    $validatedData['image'] = $blog->image;
                }
                $validatedData['user_id'] = Auth()->user()->id;
                $updated = $this->blog->update($id,$validatedData);
                $blog->tags()->sync($validatedData['tags']);
                return redirect()->route('blog.list')
                            ->with('success','Blog Updated Successfully.');
            }

            $localeList=$Locale->getActiveLocale()->toArray();
            return view('admin.blog.editblog')->with(array('blog'=>$blog,'tags'=>$taglist,'breadcrumb'=>$breadcrumb,'localelist'=>$localeList,'primary_menu'=>'blog.list'));
    }
    public function delete($id)
    {
       $blog =$this->blog->GetBlogById($id);      
        if( $blog)
        {
            $dir = public_path(). '/images/users-upload/blog/'.$blog->code.'/';
            if ($blog->image != '' && File::exists($dir,$blog->image))
            {
                File::deleteDirectory($dir);
            }
            $blog->delete();
        }
        return redirect()->route('blog.list')
        ->with('success', 'Blog has been deleted!!');
    }

     public function changeSaveMethod(Request $request)
    {
        $blog = $this->blog->GetBlogById($request->id);
        $changemethod= $request->save_method;  
        $blog->update(array('save_method'=>$changemethod));  
        return redirect()->route('blog.list')
                        ->with('success','Status change successfully.');
    }
}
