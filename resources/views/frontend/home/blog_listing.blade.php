@extends('frontend.layouts.app')
@section('content')

<section class="fullwidth-block area-padding-bottom area-padding-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    <div class="single-blog video-style">
                        <div class="thumb">
                            <a href="#">
                                <img class="img-fluid" src="{{ asset('frontend/images/categories-images/'.$category->banner_image) }}" alt="">
                            </a>
                        </div>
                    </div> 
                </div> 

                <div class="col-lg-4 col-md-5">

                    <div class="single-blog video-style small m_b_30 ">
                      <div class="short_details">
                            <a class="d-block" href="single-blog.html">
                                <h4 class="lt_ttl">{{ $category->name }}</h4>
                            </a>
                            <p>
                               The idea that the Big Bang happened everywhere
                            </p>
                            <div class="meta-bottom d-flex meta-author mt-30">

                                <div class="author">
                                   <!--  <figure>
                                    <a href="#">
                                        <img src="img/user-3.jpg" alt="" class="profile-photo-sm pull-left">
                                    </a>
                                    </figure> -->

                                    <div class="meta-author-content">
                                        <h6>
                                            <a href="#">Admin</a>
                                        </h6>
                                        <a href="#"><i class="ti-time"></i>mar 12</a>
                                        <a href="#"><i class="ti-eye"></i> 1k view</a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <a href="#" class="btn btn-round btn-light">
                                    <i class="ti-twitter-alt"></i> Follow
                                </a>
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
                            	<img class="img-fluid" src="{{ asset('/images/blog/'.$eachBlog->image) }}" alt="{{ $eachBlog->title }}">
                            @else
                            	<img class="img-fluid" src="/images/system-images/default-post.jpg }}" alt="{{ $eachBlog->title }}">
                            @endif
                        </div>
                        <div class="short_details col-lg-8 col-md-7 col-sm-12">
                            <div class="meta-top d-flex">
                            	@foreach($eachBlog->tags as $eachTags)
                                <a href="#">{{ $eachTags->name }}</a>
                                @endforeach
                            </div>
                            <a class="d-block" href="single-blog.html">
                                <h4> {{ $eachBlog->title }}</h4>
                            </a>
                            <p>{!! str_limit($eachBlog->short_description, $limit = 50, $end = '...') !!}</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i><?php echo date("M j",strtotime($eachBlog->created_at) ); ?></a>
                                <a href="#"><i class="ti-heart"></i> {{ $eachBlog->likes_count }} like</a>
                                <a href="#"><i class="ti-eye"></i> {{ $eachBlog->views }} view</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!--================ All Blog section end =================-->  
@endsection