@extends('frontend.layouts.app')
@section('content')
  
        @section('meta_url',url()->current())
        @section('meta_description',$category->meta_description)
        @section('meta_title',$category->meta_title)
        @section('meta_keyword',$category->meta_keyword)
        @section('meta_image',$category->banner_image)
  
<section class="fullwidth-block area-padding-bottom area-padding-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    <div class="single-blog video-style">
                        <div class="thumb">
                            <a href="#">
                                <img class="img-fluid" src="{{ asset('/uploads/categories-images/'.$category->banner_image) }}" alt="">
                            </a>
                        </div>
                    </div> 
                </div> 
                <div class="col-lg-4 col-md-5">
                    <div class="single-blog video-style small m_b_30 ">
                      <div class="short_details">
                            <a class="d-block" href="#">
                                <h4 class="lt_ttl">{{ $category->name }}</h4>
                            </a>
                            <p>
                                {{ $category->description }}
                            </p>
                            <div class="meta-bottom d-flex meta-author mt-30">

                                <div class="author">
                                    <div class="meta-author-content">
                                        <!-- <h6>
                                            <a href="#">Added By Admin</a>
                                        </h6> -->
                                        <a href="#"><i class="ti-time"></i> {{ $category->created_at }}</a>
                                        <a href="#"><i class="ti-list"></i> {{ $totalBlogsCount}} blogs</a>
                                    </div>
                                </div>
                                <div>
                                    <category-subscribe :slug="'{{ $category->slug }}'"></category-subscribe>
                                </div>
                                <div class="clearfix"></div>
                               <!--  <a href="#" class="btn btn-round btn-light">
                                    <i class="ti-twitter-alt"></i> Follow
                                </a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="background_one area-padding all_blog_listiing">
        <div class="container">
            <div class="row">
            	@foreach($blogByCategory as $eachBlog)
            	   <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row m_b_30">
                        <div class="thumb col-lg-4 col-md-4 col-sm-5 col-4 bg-color">
                            <figure>
                            <a>
                            	@if($eachBlog->image)
                                    @php
                                        $img=array();
                                        $img=explode('.',$eachBlog->image);
                                    @endphp
                                	<img class="img-fluid" src="{{ asset('uploads/blog/'.$eachBlog->code.'/'.$img[0].'-thumbnail.'.$img[1]) }}" alt="{{ $eachBlog->title }}">
                                @else
                                	<img class="img-fluid" src="/frontend/images/elements/default-post.jpg" alt="{{ $eachBlog->title }}">
                                @endif
                            </a>
                            </figure>
                        </div>
                        <div class="short_details col-lg-8 col-md-8 col-sm-7 col-8">
                            
                            <div class="meta-top d-flex">
                            @php
                              echo   ($eachBlog->anynomous=='2') ? (isset($eachBlog->user->name)  ? '<a href="/profile/'.$eachBlog->user->username.'">By '. $eachBlog->user->name.'</a>' : '<a >Admin</a>'):'<a > Anynomous </a>'
                            @endphp

                            </div>

                            <a class="d-block" href="{{ route('blog.detail' , [$eachBlog->code,str_slug($eachBlog->title)])}}">
                                <h4> {{ $eachBlog->title }}</h4>
                            </a>
                            <p>{!! str_limit($eachBlog->short_description, $limit = 50, $end = '...') !!}</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>{{ $eachBlog->created_at->diffForHumans() }}</a>
                                <a href="#" class="appreciate"><i>
                                    @if(auth()->user())
                                    @if(in_array($eachBlog->id,$likes->toArray()))
                                        <img src="/frontend/images/elements/appreciate.png" width="25" height="25" class="img-fluid">
                                    @else
                                        <img src="/frontend/images/elements/inactive-appreciate.png" width="25" height="25" class="img-fluid">
                                    @endif
                                @else
                                
                                    <img src="/frontend/images/elements/inactive-appreciate.png" width="25" height="25" class="img-fluid">
                                @endif
                                </i>&nbsp;&nbsp;{{$eachBlog->likes_count }} appreciate</a>
                                <a href="#"><i class="ti-eye"></i> {{ $eachBlog->views }} view</a>
                                @if(auth()->user())
                                <save-blog :blogcode="'{{$eachBlog->code}}'" v-bind:saves="{{ $savedBlog }}"></save-blog>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            <div class="col-md-12">
                @if(auth()->user())
                    <blog-loading v-bind:is-logged-in="true" v-bind:saves="{{ $savedBlog }}"  v-bind:userliked="{{$userLiked}}" :category="'{{ $category->slug }}'"></blog-loading>
                @else
                    <blog-loading :category="'{{ $category->slug }}'"></blog-loading>
                @endif
            </div>
            </div>
        </div>
    </div>
    <!--================ All Blog section end =================-->  
@endsection