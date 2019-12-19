@extends('frontend.layouts.app')
@section('content')
{{--   @section('meta_url','https://thebloggersclub.com/category/{{ $category->slug }}')

    @section('meta_title',$category->meta_title)
    @section('schema1',$category->schema1)
    @section('meta_keyword',$category->meta_keyword)
    @section('meta_description',$category->meta_description)
    @section('meta_image',asset('/uploads/categories-images/'.$category->banner_image)) --}}
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
                                        <h6>
                                            <a href="#">Added By Admin</a>
                                        </h6>
                                        <a href="#"><i class="ti-time"></i> {{ $category->created_at }}</a>
                                        <a href="#"><i class="ti-list"></i> {{ $totalBlogsCount}} blogs</a>
                                    </div>
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
                        <div class="thumb col-lg-4 col-md-5 col-sm-12">
                        	@if($eachBlog->image)
                            	<img class="img-fluid" src="{{ asset('/uploads/blog/'.$eachBlog->code.'/'.$eachBlog->image) }}" alt="{{ $eachBlog->title }}">
                            @else
                            	<img class="img-fluid" src="/frontend/images/elements/default-post.jpg" alt="{{ $eachBlog->title }}">
                            @endif
                        </div>
                        <div class="short_details col-lg-8 col-md-7 col-sm-12">
                            
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
                                </i>&nbsp;&nbsp;{{$eachBlog->likes_count }} like</a>
                                <a href="#"><i class="ti-eye"></i> {{ $eachBlog->views }} view</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <blog-loading :category="'{{ $category->slug }}'"></blog-loading>
            </div>
        </div>
    </div>
    <!--================ All Blog section end =================-->  
@endsection