@extends('frontend.layouts.app')
@section('content')

 <div class="spinner-border text-primary" role="status">
  <span class="sr-only">Loading...</span>
</div>
 <!--================Fullwidth block Area =================-->

    <section class="fullwidth-block area-padding-bottom area-padding-top">
        <div class="container">
            <div class="row">
            	@if($featuredBlog['0'])
                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style">
                        <div class="thumb">
                            <a href="#">
                                @if($featuredBlog['0']->image)
                                 <img class="img-fluid" src="{{ asset('images/blog/'.$featuredBlog['0']->image) }}" alt="">
                            @else
                                 <img class="img-fluid" src="{{ asset('images/system-images/default-post.jpg') }}" alt="">
                            @endif
                            </a>
                        </div>
                        <div class="short_details">
                            <a class="d-block"  href="{{ route('blog.detail' , $featuredBlog['0']->code)}}">
                                <h4>{{ str_limit($featuredBlog['0']->title, $limit = 150, $end = '...') }}</h4>
                            </a>
                            <p>
                               {{ str_limit($featuredBlog['0']->short_description, $limit = 150, $end = '...') }}
                            </p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>&nbsp;{{ $featuredBlog['0']->created_at->diffForHumans() }} </a>
                                <a href="#" class="appreciate"><i>
                                    <img src="images/appreciate-active.gif" width="25" height="25" class="img-fluid">
                                </i>&nbsp;&nbsp;{{$featuredBlog['0']->likes_count }} like</a>
                                <a href="#"><i class="ti-eye"></i>&nbsp;{{$featuredBlog['0']->views }} view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div> 

                </div> 
                @endif
                <?php unset($featuredBlog['0']); ?>
                <div class="col-lg-6 col-md-6">
                	@foreach($featuredBlog as $eachFeaturedBlog)
                    <div class="single-blog video-style small row m_b_30">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    @if($eachFeaturedBlog->image)
                                 <img class="img-fluid" src="{{ asset('images/blog/'.$eachFeaturedBlog->image) }}" alt="">
                            @else
                                 <img class="img-fluid" src="{{ asset('images/system-images/default-post.jpg') }}" alt="">
                            @endif
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block"  href="{{ route('blog.detail' , $eachFeaturedBlog->code)}}">
                                <h4>{{ str_limit($eachFeaturedBlog->title, $limit = 150, $end = '...') }}</h4>
                            </a>
                            <p>{{ str_limit($eachFeaturedBlog->short_description, $limit = 150, $end = '...') }}</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>&nbsp;{{ $eachFeaturedBlog->created_at->diffForHumans() }}</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="images/appreciate-active.gif" width="25" height="25" class="img-fluid">
                                </i>&nbsp; &nbsp;{{$eachFeaturedBlog->likes_count }} like</a>
                                <a href="#"><i class="ti-eye"></i>&nbsp;{{$eachFeaturedBlog->views }} view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div> 
                    @endforeach
                    

                    <div class="text-right">
                        <a href="#" class="b_all genric-btn link-border circle">See All <i class="fa fa-angle-double-right"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!--================Fullwidth block Area end =================-->

    <!--================ Latest Featured section start =================-->  

    <div class="latest-news  area-padding-bottom area-padding-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="area-heading">
                        <h3>Featured for members</h3>
                    </div>
                </div>
            </div>
            <div class="row">
            	@if($featuredForMember['0'])
               <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style">
                        <div class="thumb">
                            <a href="#">
                                @if($featuredForMember['0']->image)
                                 <img class="img-fluid" src="{{ asset('images/blog/'.$featuredForMember['0']->image) }}" alt="">
                            @else
                                 <img class="img-fluid" src="{{ asset('images/system-images/default-post.jpg') }}" alt="">
                            @endif
                            </a>
                        </div>
                        <div class="short_details">
                            <a class="d-block"  href="{{ route('blog.detail' , $featuredForMember['0']->code)}}">
                                <h4>{{ str_limit($featuredForMember['0']->title, $limit = 150, $end = '...') }}</h4>
                            </a>
                            <p>
                               {{ str_limit($featuredForMember['0']->short_description, $limit = 150, $end = '...') }}
                            </p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>&nbsp;{{ $featuredForMember['0']->created_at->diffForHumans() }} </a>
                                <a href="#" class="appreciate"><i>
                                    <img src="images/appreciate-active.gif" width="25" height="25" class="img-fluid">
                                </i>&nbsp;{{$featuredForMember['0']->likes_count }} like</a>
                                <a href="#"><i class="ti-eye"></i>&nbsp;{{$featuredForMember['0']->views }} view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div> 
                </div> 
                @endif
                <?php unset($featuredForMember['0']); ?>
                <div class="col-lg-6 col-md-6">
                    @foreach($featuredForMember as $eachFeaturedForMember)
                    <div class="single-blog video-style small row m_b_30">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    @if($eachFeaturedForMember->image)
                                 <img class="img-fluid" src="{{ asset('images/blog/'.$eachFeaturedForMember->image) }}" alt="">
                            @else
                                 <img class="img-fluid" src="{{ asset('images/system-images/default-post.jpg') }}" alt="">
                            @endif
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block"  href="{{ route('blog.detail' , $eachFeaturedForMember->code)}}">
                                <h4>{{ str_limit($eachFeaturedForMember->title, $limit = 150, $end = '...') }}</h4>
                            </a>
                            <p>{{ str_limit($eachFeaturedForMember->short_description, $limit = 150, $end = '...') }}</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>&nbsp;{{ $eachFeaturedForMember->created_at->diffForHumans() }} </a>
                                <a href="#" class="appreciate"><i>
                                    <img src="images/appreciate-active.gif" width="25" height="25" class="img-fluid">
                                &nbsp;</i>{{$eachFeaturedForMember->likes_count }} like</a>
                                <a href="#"><i class="ti-eye"></i>&nbsp;{{$eachFeaturedForMember->views }} view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div> 
                    @endforeach

                    <div class="text-right">
                        <a href="#" class="b_all genric-btn link-border circle">See All <i class="fa fa-angle-double-right"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!--================ Latest Featured section end =================--> 


    <!--================ First block section start =================-->      

    <section class="first_block area-padding-top area-padding-bottom">
        <div class="container">
            <div class="area-heading">
                <h3>Popular</h3>
            </div>
            <div class="row">
            	@if($popular['0'])
                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style">
                        <div class="thumb">
                            <a href="#">
                                @if($popular['0']->image)
                                 <img class="img-fluid" src="{{ asset('images/blog/'.$popular['0']->image) }}" alt="">
                            @else
                                 <img class="img-fluid" src="{{ asset('images/system-images/default-post.jpg') }}" alt="">
                            @endif
                            </a>
                        </div>
                        <div class="short_details">
                            <a class="d-block"  href="{{ route('blog.detail' , $popular['0']->code)}}">
                                <h4>{{ str_limit($popular['0']->title, $limit = 150, $end = '...') }}</h4>
                            </a>
                            <p>
                               {{ str_limit($popular['0']->short_description, $limit = 150, $end = '...') }}
                            </p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>&nbsp;{{ $popular['0']->created_at->diffForHumans() }} </a>
                                <a href="#" class="appreciate"><i>
                                    <img src="images/appreciate-active.gif" width="25" height="25" class="img-fluid">
                                &nbsp;</i>{{$popular['0']->likes_count }} like</a>
                                <a href="#"><i class="ti-eye"></i>&nbsp;{{$popular['0']->views }} view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div> 

                </div> 
                @endif
                <?php unset($popular['0']); ?>
                <div class="col-lg-6 col-md-6">
                	@foreach($popular as $eachPopular)
                    <div class="single-blog video-style small row m_b_30">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    @if($eachPopular->image)
                                 <img class="img-fluid" src="{{ asset('images/blog/'.$eachPopular->image) }}" alt="">
                            @else
                                 <img class="img-fluid" src="{{ asset('images/system-images/default-post.jpg') }}" alt="">
                            @endif
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block"  href="{{ route('blog.detail' , $eachPopular->code)}}">
                                <h4>{{ str_limit($eachPopular->title, $limit = 150, $end = '...') }}</h4>
                            </a>
                            <p>{{ str_limit($eachPopular->short_description, $limit = 150, $end = '...') }}</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>&nbsp;
                                {{ $eachPopular->created_at->diffForHumans() }} </a>
                                <a href="#" class="appreciate"><i>
                                    <img src="images/appreciate-active.gif" width="25" height="25" class="img-fluid">
                                &nbsp;</i>{{$eachPopular->likes_count }} like</a>
                                <a href="#"><i class="ti-eye"></i>&nbsp;{{$eachPopular->views }} view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div> 
                    @endforeach
                    

                    <div class="text-right">
                        <a href="#" class="b_all genric-btn link-border circle">See All <i class="fa fa-angle-double-right"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--================ First block section end =================-->       

    
    <!--================ three-block section start =================-->  
    <div class="three-block  area-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="area-heading">
                        <h3>Recent</h3>
                    </div>
                </div>
            </div>

            <div class="row">
            	@foreach($latest as $eachLatest)
                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row m_b_30">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                @if($eachLatest->image)
	                                <img class="img-fluid" src="{{ asset('images/blog/'.$eachLatest->image) }}" alt="">
	                            @else
	                                <img class="img-fluid" src="{{ asset('images/system-images/default-post.jpg') }}" alt="">
	                            @endif
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block"  href="{{ route('blog.detail' , $eachPopular->code)}}">
                                <h4>{{ str_limit($eachLatest->title, $limit = 150, $end = '...') }}</h4>
                            </a>
                            <p>{{ str_limit($eachLatest->short_description, $limit = 150, $end = '...') }}</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>&nbsp;
                                {{ $eachLatest->created_at->diffForHumans() }} </a>
                                <a href="#" class="appreciate"><i>
                                    <img src="images/appreciate-active.gif" width="25" height="25" class="img-fluid">
                                &nbsp;</i>{{$eachLatest->likes_count }} like</a>
                                <a href="#"><i class="ti-eye"></i>{{$eachLatest->views }} view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <latest-blog-loading></latest-blog-loading>
            </div>
        </div>
    </div>
    <!--================ three-block section end =================-->  
@endsection