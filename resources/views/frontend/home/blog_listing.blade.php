@extends('frontend.layouts.app')
@section('content')
	<!--================ All Blog section start =================-->  

    <div class="background_one area-padding all_blog_listiing">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="area-heading">
                        <h3>{{ $category->name }}</h3>
                    </div>
                </div>
            </div>
            <div class="row">
            	@foreach($blogByCategory as $eachBlog)
            	<div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="single-blog video-style small row m_b_30">
                        <div class="thumb col-lg-3 col-md-4 col-sm-5">
                        	@if($eachBlog->image)
                            	<img class="img-fluid" src="{{ asset('images/blog/'.$eachBlog->image) }}" alt="Blog Image Name Goes Here">
                            @else
                            	<img class="img-fluid" src="{{ asset('images/blog/default.jpg') }}" alt="Blog Image Name Goes Here">
                            @endif
                        </div>
                        <div class="short_details col-lg-9 col-md-8 col-sm-7">
                            <div class="meta-top d-flex">
                            	@foreach($eachBlog->tags as $eachTags)
                                <a href="#">{{ $eachTags->name }}</a>
                                @endforeach
                            </div>
                            <a class="d-block" href="single-blog.html">
                                <h4> {{ $eachBlog->title }}</h4>
                            </a>
                            <p>{!! str_limit($eachBlog->content, $limit = 500, $end = '...') !!}</p>
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
            <nav class="blog-pagination justify-content-center d-flex">
                <ul class="pagination">
                <li class="page-item">
                <a href="#" class="page-link" aria-label="Previous">
                <i class="ti-angle-left"></i>
                </a>
                </li>
                <li class="page-item active">
                <a href="#" class="page-link">1</a>
                </li>
                <li class="page-item">
                <a href="#" class="page-link">2</a>
                </li>
                <li class="page-item">
                <a href="#" class="page-link" aria-label="Next">
                <i class="ti-angle-right"></i>
                </a>
                </li>
                </ul>
            </nav>
        </div>
    </div>

    <!--================ All Blog section end =================-->  
@endsection