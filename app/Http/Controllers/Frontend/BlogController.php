<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Repository\TagInterface;
use Validator,Redirect,Response,File;
use Image;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repository\BlogInterface; 
use App\Http\Requests\BlogRequest;
class BlogController extends FrontendController
{
    protected $data;
	protected $blog;
    use AuthorizesRequests;

    function __construct(BlogInterface $blog)
    {
        parent::__construct();
        $this->blog=$blog;
    }
   	public function create(Request $request,TagInterface $tag){
     try{
        $routeName= Route::currentRouteName();
        if($routeName=='api')
           {
            $data['options'] = $tag->getAll()->where('status',1)->get(['name'])->toArray();
              return ($data);
           }
           else
           {
                if($request->method()=='POST'){
                        $input = $request->all();
                        $blogCode=$request->code;
                        if(($request->code==null || $request->code==''))
                        {

                            $input['locale_id']='1';
                            $input['user_id']=Auth()->user()->id;
                            $input['anynomous'] = '2';
                            $created = $this->blog->create($input);
                            $code= uniqid();
                            $part1=substr($code,0, 7).str_pad($created->id,4,0,STR_PAD_BOTH);
                            $part2=substr($code, 7,-1);
                            $created['code']= $part1.$part2;
                            $created->save();
                            $blogCode=$created['code'];
                           
                        }
                        if($request->media=='yes')
                        {
                            $response=$this->uploadOnlyMediaForBlog(request()->image,$blogCode);
                            return $response;
                        }
                        
                           $validator = Validator::make($request->all(), [ 
                                'title' => 'required|max:150', 
                                'content' => 'required', 
                            ]);
                            if ($validator->fails()) {
                                return response()->json(['status'=>false,'data'=>'','message'=>$validator->errors()], 401);            
                            }
                            $this->blog->updateByCode($input['code'],['title'=>$input['title'],'content'=>$input['content']]);
                        
                 return response()->json(['status'=>true,'blogId'=>$blogCode,'message'=>'BlogblogCode saved succeessfully']);

                }
          }
          $data['options'] = $tag->getAll()->where('status',1)->get(['name'])->toArray();
          $initialState=json_encode($data);
          $user=$this->user_state_info();
          return view('frontend.layouts.dashboard',['initialState'=>$data,'user'=>$user]);
       }
      catch(Exception $e)
      {
          return response()->json(['status'=>false,'message'=>'Some Error Occured.\n Please try again in a while!!']);
      }
   	}

    public function resizeImage($code,$width,$name)
    {
        $imagePath=public_path(). '/uploads/blog/'.$code.'/'.$name;
        if(File::exists($imagePath))
        {
          $img = Image::make($imagePath);
          $img->resize($width, null, function ($constraint) 
          {
                $constraint->aspectRatio();
                $constraint->upsize();
          });
          return $img->response('jpg'); 
        }
       abort(404);
    }
    public function update(Request $request,$blogCode,TagInterface $tag)
    {
        $routeName= Route::currentRouteName();
        $data['options'] = $tag->getAll()->where('status',1)->get(['name'])->toArray();
        $data['blog']   = $this->blog->getBlogByCode($blogCode);
        $this->authorize('updateBlog', $data['blog']);
        if($routeName=='api')
           {
              return ($data);
           }
           else
           {
            if($request->method()=='POST')
            {
                $validator = Validator::make($request->all(), 
                [ 
                    'title' => 'required', 
                    'content' => 'required', 
                ]);
                
                if ($validator->fails()) {
                    return response()->json(['status'=>false,'data'=>'','message'=>$validator->errors()], 401);            
                }
                else{
                        $input = $request->all();
                        $this->blog->updateByCode($blogCode,['title'=>$input['title'],'content'=>$input['content']]);
                        return response()->json(['status'=>true,'blogId'=>$blogCode,'message'=>'Blog Saved!']);
                }
            } 
            $initialState=json_encode($data);
            $user=$this->user_state_info();
            return view('frontend.layouts.dashboard',['initialState'=>$data,'user'=>$user]);
        }
    }
    public function updateBlogDetail(Request $request,$postId,TagInterface $tag)
    {
        $routeName= Route::currentRouteName();
        $data['options'] = $tag->getTagsList();
        $user=$this->user_state_info();
        $blogData   = $this->blog->getBlogByCode($postId);
        $data['blog'] = $blogData;
         $allowedFileExtension=['jpg','png','jpeg','gif','svg'];
        if($routeName=='api')
        {
            return ($data);
        }
        else
        {
            $data = [];
            $data['path']='/blog/edit/'.$postId;
            if($request->method()=='POST'){
                $validator = Validator::make($request->all(), [ 
                'short_description' => 'required',
                'tags'              =>'' ,
                // 'image'             => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                
                    if ($validator->fails()) {
                        return response()->json(['status'=>false,'data'=>'','message'=>$validator->errors()], 401);            
                    }else{
                        if(request()->image)
                        {
                            $uniq = time();
                            $extension = request()->image->getClientOriginalExtension();
                            $imageName = $uniq.'.'.$extension; 
                            $check=in_array($extension,$allowedFileExtension);
                            if($check)
                            {
                                $dir=public_path().'/uploads/blog/'.$postId.'/';
                                if(!is_dir($dir))
                                {
                                    File::makeDirectory($dir, 0777, true, true);
                                }
                                $tmpImg =request()->image->move($dir,$imageName);
                                $img = Image::make($tmpImg);
                                list($width,$height) = getimagesize($tmpImg);       
                                    $img->resize(700,null, function ($constraint) 
                                    {
                                    $constraint->aspectRatio();
                                     })->save($dir.'/'.$uniq.'.'.$extension);            
                                $img->resize(200, 200, function ($constraint) 
                                {
                                 $constraint->aspectRatio();
                                }
                                )->save($dir.'/'.$uniq.'-thumbnail.'.$extension);

                                $form['image'] = $imageName;
                            }else{
                                return response()->json(['status'=>false,'data'=>'','message'=>'The image file type must be:jpeg,png,jpg,gif,svg'], 401);
                            }
                        }
                        $checkAnynomous=$request->isAnynomous;
                        $form['short_description']=$request->short_description;
                        $form['save_method']=$request->save_method?$request->save_method:'1';
                        $form['anynomous'] = ($checkAnynomous==='true') ? '1' : '2';
                        $form['featured'] = '2';
                        $form['show_in_home'] = '2';
                        if($this->blogRequiresActivation=='N')
                            $form['show_in_home'] = '1';
                        $this->blog->updateByCode($postId,$form);
                        $tagid = $tag->getTagByName($request->tags);
                        $this->blog->addTag($postId,$tagid);  
                        if($blogData->image!=null || $blogData->image!='' )
                        {
                            $partsOldImage=explode('.',$blogData->image);
                            @$thumbimage=$partsOldImage[0].'-thumbnail.'.$partsOldImage[1];
                            @unlink($dir.'/'.$blogData->image);
                            @unlink($dir.'/'.$thumbimage);
                        }
                        
                        return response()->json(['status'=>true,'blogId'=>$postId,'message'=>'Blog updated successfully']);                
                    }
            }
            return view('frontend.layouts.dashboard',['initialState'=>$data,'user'=>$user]);
        }
    }   
    public function preview($code,Request $request){
        $blogDetails = $this->blog->getBlogByCode($code);
        $data['blog'] =$blogDetails;
        $routeName= ROUTE::currentRouteName();
        if($routeName=='api')
        {
            return ($data);
        }
        else
        {
            $data['path']='/preview/'.$code;
            $initialState=json_encode($data);
            $user=$this->user_state_info();
            return view('frontend.layouts.dashboard',['initialState'=>$data,'user'=>$user]);
        }        
    }

    public function delete($blogCode){
        $blogData = $this->blog->getBlogByCode($blogCode);
        $data['blog'] = $blogData;
        $this->authorize('deleteBlog', $data['blog']);
        if( $blogData)
        {
            $dir = public_path(). '/uploads/blog/'.$blogData->code.'/';
            if ($blogData->image != '' && File::exists($dir,$blogData->image))
            {
                File::deleteDirectory($dir);
            }
            $blogData->delete();
            return response()->json(['status'=>true,'data'=>'','message'=>'Blog Deleted successfully']);
        }
       return response()->json(['status'=>false,'data'=>'','message'=>'Something went wrong!!']);
    }

    private function uploadOnlyMediaForBlog($image,$code)
    {
        try
        {
             if(!($image || $code) ) throw new Exception("Error Processing Request", 1);
                $uniqId = time();
                $extension = $image->getClientOriginalExtension();
                $imageName = $uniqId.'.'.$extension; 
                $allowedFileExtension=['jpg','png','jpeg','gif','svg'];
                $check=in_array($extension,$allowedFileExtension);
                if($check)
                {
                    $dir=public_path().'/uploads/blog/'.$code.'/';
                    if(!is_dir($dir))
                    {
                        File::makeDirectory($dir, 0777, true, true);
                    }
                    $tmpImg =$image->move($dir,$imageName);
                    $img = Image::make($tmpImg);
                    list($width,$height) = getimagesize($tmpImg);    
                    if($width > 1000 && $height < 1000)
                    {                  
                        $img->resize(700,null, function ($constraint) 
                        {
                        $constraint->aspectRatio();
                         })->save($dir.'/'.$uniqId.'.'.$extension);            
                    }
                    else if($width < 1000 && $height > 1000)
                    {
                         $img->resize(null,600, function ($constraint) 
                        {
                        $constraint->aspectRatio();
                         })->save($dir.'/'.$uniqId.'.'.$extension);
                    } 
                    else if($width < 1000 && $height > 1000)
                    {
                         $img->resize(null,600, function ($constraint) 
                        {
                        $constraint->aspectRatio();

                         })->save($dir.'/'.$uniqId.'.'.$extension);
                    }       
                    $form['image'] = $imageName;
                    return response()->json(['status'=>true,'url'=>url('/uploads/blog/'.$code.'/'.$imageName),'code'=>$code]);
                }
                else{
                    return response()->json(['status'=>false,'data'=>'','message'=>'The image file type must be:jpeg,png,jpg,gif,svg'], 401);
                }
        }
        catch(Exception $e)
        {
             return response()->json(['status'=>false,'data'=>'','message'=>'Something went wrong!! while uploading file']);
        }
    }
}
