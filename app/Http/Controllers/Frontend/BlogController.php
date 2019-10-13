<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

use Validator,Redirect,Response,File;
use App\Repository\BlogInterface; 
use App\Http\Requests\BlogRequest;
class BlogController extends FrontendController
{
	protected $blog;
    function __construct(BlogInterface $blog)
    {
        parent::__construct();
        $this->blog=$blog;
    }

   	public function create(Request $request){
        if($request->method()=='POST'){
            $validator = Validator::make($request->all(), [ 
            'title' => 'required', 
            'content' => 'required', 
            // 'bannerImage' => 'required', 
            ]);
            if($this->blogRequiresActivation=='N'){
                return response()->json(['status'=>false,'data'=>'','message'=>'Post cannot be created for now. Please try again later'], 401);
            }else{
                if ($validator->fails()) {
                    return response()->json(['status'=>false,'data'=>'','message'=>$validator->errors()], 401);            
                }else{
                    $input = $request->all(); 
                    $input['locale_id']='1';
                    $input['image']='211.jpg';
                    $input['user_id']=Auth()->user()->id;
                    $created = $this->blog->create($input);
                    $code= uniqid();
                    $part1=substr($code,0, 7).str_pad($created->id,4,0,STR_PAD_BOTH);
                    $part2=substr($code, 7,-1);
                    $created['code']= $part1.$part2;
                    $created->save();
                    return response()->json(['status'=>true,'blogId'=>$created['code'],'message'=>'Post saved successfully']);
                }
            } 
        }
         return view('frontend.layouts.dashboard',['initialState'=>'','user'=>'']);
   	}
    public function updateBlogDetail(Request $request,$postId){
        if($request->method()=='POST'){
            $validator = Validator::make($request->all(), [ 
            'short_description' => 'required', 
            ]);
            if($this->blogRequiresActivation=='N'){
                return response()->json(['status'=>false,'data'=>'','message'=>'Post cannot be created for now. Please try again later'], 401);
            }else{
                if ($validator->fails()) {
                    return response()->json(['status'=>false,'data'=>'','message'=>$validator->errors()], 401);            
                }else{
                    $input = $request->all(); 
                    $input['locale_id']='1';
                    $input['image']='211.jpg';
                    $input['user_id']=Auth()->user()->id;
                    $created = $this->blog->create($input);
                    $code= uniqid();
                    $part1=substr($code,0, 7).str_pad($created->id,4,0,STR_PAD_BOTH);
                    $part2=substr($code, 7,-1);
                    $created['code']= $part1.$part2;
                    $created->save();
                    
                }
            } 
        }
         return view('frontend.layouts.dashboard',['initialState'=>'','user'=>'']);
    }
   
}
