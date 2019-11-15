@extends('frontend.layouts.app')
@section('content')

<section class="fullwidth-block area-padding-bottom area-padding-top">
        <div class="container">
            <div class="row">
            	@if($slug=='all-featured')
		          <h1>All Featured Collection</h1>
		        @elseif($slug=='popular')
		          <h1>All Popular Blog Collection</h1>
		        @elseif($slug=='featured-for-member')
            		<h1>All Featured For Member Collection</h1>
            	@endif
            </div>
        </div>
    </section>

    <div class="background_one area-padding all_blog_listiing">
        <div class="container">
            <div class="row">
            	@foreach($blogs as $eachBlog)
            	   <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row m_b_30">
                        <div class="thumb col-lg-4 col-md-5 col-sm-12">
                        	@if($eachBlog->image)
                            	<img class="img-fluid" src="{{ asset('/uploads/blog/'.$eachBlog->code.'/'.$eachBlog->image) }}" alt="{{ $eachBlog->title }}">
                            @else
                            	<img class="img-fluid" src="/images/system-images/default-post.jpg" alt="{{ $eachBlog->title }}">
                            @endif
                        </div>
                        <div class="short_details col-lg-8 col-md-7 col-sm-12">
                            <div class="meta-top d-flex">
                            	@foreach($eachBlog->tags as $eachTags)
                                <a href="#">{{ $eachTags->name }}</a>
                                @endforeach
                            </div>
                            <a class="d-block" href="{{ route('blog.detail' , $eachBlog->code)}}">
                                <h4> {{ $eachBlog->title }}</h4>
                            </a>
                            <p>{!! str_limit($eachBlog->short_description, $limit = 50, $end = '...') !!}</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>{{ $eachBlog->created_at->diffForHumans() }}</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="/images/appreciate-active.gif" width="25" height="25" class="img-fluid">
                                </i>&nbsp;&nbsp;{{$eachBlog->likes_count }} like</a>
                                <a href="#"><i class="ti-eye"></i> {{ $eachBlog->views }} view</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <blog-slug-loading :slug="'{{ $slug }}'"></blog-slug-loading>
            </div>
        </div>
    </div>

    <!--================ All Blog section end =================-->  
@endsection