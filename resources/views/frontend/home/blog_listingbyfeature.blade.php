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
                        <div class="thumb col-lg-4 col-md-4 col-sm-5 col-4">
                        	@if($eachBlog->image)
                                @php
                                    $img=array();
                                    $img=explode('.',$eachBlog->image);
                                @endphp
                            	<img class="img-fluid" src="{{ asset('uploads/blog/'.$eachBlog->code.'/'.$img[0].'-thumbnail.'.$img[1]) }}" alt="{{ $eachBlog->title }}">
                            @else
                            	<img class="img-fluid" src="/frontend/images/elements/default-post.jpg" alt="{{ $eachBlog->title }}">
                            @endif
                        </div>
                        <div class="short_details col-lg-8 col-md-8 col-sm-7 col-8">
                            <div class="meta-top d-flex">
                            	@php
                          echo   ($eachBlog->anynomous=='2') ? (isset($eachBlog->user->name)  ? '<a href="/profile/'.$eachBlog->user->username.'">By '. $eachBlog->user->name.'</a>' : '<a >Admin</a>'):'<a > Anynomous </a>'
                            @endphp
                            </div>
                            <a class="d-block" href="{{ route('blog.detail' ,[$eachBlog->code,$eachBlog->title])}}">
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
                @if(auth()->user())
                    <blog-slug-loading v-bind:is-logged-in="true" v-bind:saves="{{ $savedBlog }}"  v-bind:userliked="{{$userLiked}}" :slug="'{{ $slug }}'"></blog-slug-loading>
                @else
                    <blog-slug-loading :slug="'{{ $slug }}'"></blog-slug-loading>
                @endif
            </div>
        </div>
    </div>

    <!--================ All Blog section end =================-->  
@endsection