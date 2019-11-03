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
        $routeName= Route::currentRouteName();
        if($routeName=='api')
           {
            $data['options'] = $tag->getAll()->where('status',1)->get(['name'])->toArray();
              return ($data);
           }
           else
           {
            if($request->method()=='POST'){
            $validator = Validator::make($request->all(), [ 
            'title' => 'required', 
            'content' => 'required', 
            ]);
            if($this->blogRequiresActivation=='N'){
                return response()->json(['status'=>false,'data'=>'','message'=>'Blog cannot be created for now. Please try again later'], 401);
            }else{
                if ($validator->fails()) {
                    return response()->json(['status'=>false,'data'=>'','message'=>$validator->errors()], 401);            
                }else{
                    $input = $request->all();
                    $input['locale_id']='1';
                    $input['user_id']=Auth()->user()->id;
                    $created = $this->blog->create($input);
                    $code= uniqid();
                    $part1=substr($code,0, 7).str_pad($created->id,4,0,STR_PAD_BOTH);
                    $part2=substr($code, 7,-1);
                    $created['code']= $part1.$part2;
                    $created->save();
                    return response()->json(['status'=>true,'blogId'=>$created['code'],'message'=>'Blog saved successfully']);
                }
            } 
          }
          $data['options'] = $tag->getAll()->where('status',1)->get(['name'])->toArray();
          $initialState=json_encode($data);
          $user=$this->user_state_info();
          return view('frontend.layouts.dashboard',['initialState'=>$data,'user'=>$user]);
       }
   	}
    public function update(Request $request,$blogCode,TagInterface $tag)
    {
            $routeName= Route::currentRouteName();
            $data['options'] = $tag->getAll()->where('status',1)->get(['name'])->toArray();
            $data['blog']   = $this->blog->getBlogByCode($blogCode);
                 $this->authorize('update', $data['blog']);
                if($routeName=='api')
                   {
                      return ($data);
                   }
                   else
                   {
                    if($request->method()=='POST')
                    {
                        $validator = Validator::make($request->all(), [ 
                        'title' => 'required', 
                        'content' => 'required', 
                        ]);
                        if($this->blogRequiresActivation=='N'){
                            return response()->json(['status'=>false,'data'=>'','message'=>'Blog cannot be created for now. Please try again later'], 401);
                        }else{
                            if ($validator->fails()) {
                                return response()->json(['status'=>false,'data'=>'','message'=>$validator->errors()], 401);            
                            }else{
                                    $input = $request->all();
                                    $this->blog->updateByCode($blogCode,$input);
                                    return response()->json(['status'=>true,'blogId'=>$blogCode,'message'=>'Blog Saved!']);
                            }
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
        $data['blog']   = $this->blog->getBlogByCode($postId);
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
                'tags'              =>'required' ,
                // 'image'             => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                if($this->blogRequiresActivation=='N'){
                    return response()->json(['status'=>false,'data'=>'','message'=>'Blog cannot be created for now. Please try again later'], 401);
                }else{
                    if ($validator->fails()) {
                        return response()->json(['status'=>false,'data'=>'','message'=>$validator->errors()], 401);            
                    }else{
                        if(request()->image)
                        {
                            $imageName = time().'.'.request()->image->getClientOriginalExtension();
                            request()->image->move(public_path('images/blog'), $imageName);
                            $form['image']=$imageName;
                        }
                        $form['short_description']=$request->short_description;
                        $form['save_method']='1';
                        $form['anynomous'] = $request->isAnynomous ? '1' : '2';
                        $this->blog->updateByCode($postId,$form);
                        $tagid = $tag->getTagByName($request->tags);
                        $this->blog->addTag($postId,$tagid);  
                        return response()->json(['status'=>true,'blogId'=>$postId,'message'=>'Blog updated successfully']);                
                    }
                } 
            }
              return view('frontend.layouts.dashboard',['initialState'=>$data,'user'=>'']);
        }
    }   
}
