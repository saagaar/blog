@extends('frontend.layouts.app')
@section('content')
<section class="fullwidth-block area-padding-bottom">
        <div class="container-fluid">
            <div class="row">
                @if($featuredBlog['0'])
                <div class="col-md-6 col-lg-6 col-xl-5">
                    <div class="single-blog  wow fadeInUp" data-wow-duration="2s" data-wow-delay=".2s">
                        <div class="thumb">
                            @if($featuredBlog['0']->image)
                                 <img class="img-fluid" src="{{ asset('images/blog/'.$featuredBlog['0']->image) }}" alt="">
                            @else
                                 <img class="img-fluid" src="{{ asset('images/blog/defaut.jpg') }}" alt="">
                            @endif
                           
                        </div>
                        <div class="short_details">
                            <div class="meta-top d-flex">
                                <a href="/test">Tours & Travel</a>
                            </div>
                            <a class="d-block" href="{{ route('blog.detail' , $featuredBlog['0']->code)}}">
                                <h5>{{ str_limit($featuredBlog['0']->title, $limit = 150, $end = '...') }} </h5>
                                <!-- <h5>{{ $featuredBlog['0']->title }}</h5> -->
                            </a>
                            <div class="meta-bottom d-flex" >
                                <a href="#">March 12 , 2019 . </a>
                                <a class="dark_font" href="#"> &nbsp; By Bikash Bhandari</a>
                            </div>
                        </div>
                    </div>    
                </div>
                @endif
                 
                <div class="col-lg-12 col-xl-3">
                    <div class="row">
                        @if($featuredBlog['1'])
                        <div class="col-12 col-md-6 col-lg-6 col-xl-12">
                            <div class="single-blog style-three m_b_30">
                                <div class="thumb">
                                    @if($featuredBlog['1']->image)
                                 <img class="img-fluid" src="{{ asset('images/blog/'.$featuredBlog['1']->image) }}" alt="">
                            @else
                                 <img class="img-fluid" src="{{ asset('images/blog/defaut.jpg') }}" alt="">
                            @endif
                                </div>
                                <div class="short_details">

                                    <div class="meta-top d-flex justify-content-center">
                                        <a href="#">Lifestyle</a>
                                    </div>
                                    <a class="d-block" href="{{ route('blog.detail' , $featuredBlog['1']->code)}}">
                                        <h5>{{ str_limit($featuredBlog['1']->title, $limit = 150, $end = '...') }} </h5>
                                    </a>
                                </div>
                            </div>

                        </div>
                        @endif
                        @if($featuredBlog['2'])
                        <div class="col-12 col-md-6 col-lg-6 col-xl-12">
                            <div class="single-blog style-three">
                                <div class="thumb">
                                    @if($featuredBlog['2']->image)
                                 <img class="img-fluid" src="{{ asset('images/blog/'.$featuredBlog['2']->image) }}" alt="">
                            @else
                                 <img class="img-fluid" src="{{ asset('images/blog/defaut.jpg') }}" alt="">
                            @endif
                                </div>
                                <div class="short_details">

                                    <div class="meta-top d-flex justify-content-center">
                                        <a href="#">Lifestyle</a>
                                    </div>
                                    <a class="d-block" href="{{ route('blog.detail' , $featuredBlog['2']->code)}}">
                                        <h5>{{ str_limit($featuredBlog['2']->title, $limit = 150, $end = '...') }} </h5>
                                    </a>
                                </div>
                            </div>    
                        </div>
                        @endif
                    </div>

                </div>

                @if($featuredBlog['3'])
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="single-blog style_two">
                        <div class="thumb">
                            @if($featuredBlog['3']->image)
                                 <img class="img-fluid" src="{{ asset('images/blog/'.$featuredBlog['3']->image) }}" alt="">
                            @else
                                 <img class="img-fluid" src="{{ asset('images/blog/defaut.jpg') }}" alt="">
                            @endif
                        </div>
                        <div class="short_details text-center ">

                            <div class="meta-top d-flex justify-content-center">
                                <a href="#">Tours & Travel</a>
                            </div>
                            <a class="d-block" href="{{ route('blog.detail' , $featuredBlog['3']->code)}}">
                                <h5>{{ str_limit($featuredBlog['3']->title, $limit = 150, $end = '...') }} </h5>
                            </a>
                            <div class="meta-bottom d-flex justify-content-center">
                                <a href="#">March 12 , 2019 . </a>
                                <a href="#">&nbsp; By Bikash Bhandari</a>
                            </div>
                        </div>
                    </div>    
                </div>
                @endif
                <div class="clearfix"></div>
            </div>
            <div class="taxt-right all-link">
                <a href="#">See All Featured&nbsp;<i class="fa fa-angle-double-right"></i></a>
            </div>
        </div>
    </section>

    <!--================Fullwidth block Area end =================-->

    <!--================ Latest Featured section start =================-->  

    <div class="latest-news  area-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="area-heading">
                        <h3>Featured for members <span> <a href="#" class="b_all genric-btn link-border circle">See All <i class="fa fa-angle-double-right"></i></a> </span></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="single-blog style-five">
                        <div class="thumb">
                            <img class="img-fluid" src="/images/magazine/18.jpg" alt="">
                        </div>
                        <div class="short_details">
                            <div class="meta-top d-flex">
                                <a href="#">shoes</a>/
                                <a href="#">March 15, 2019</a>
                            </div>
                            <a class="d-block" href="single-blog.html">
                                <h4>Brought dreepeth youll blessed
                                from whose signs over</h4>
                            </a>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-comment"></i>05 comment</a>
                                <a href="#"><i class="ti-heart"></i> 0 like</a>
                            </div>
                        </div>
                    </div> 

                </div> 

                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="single-blog style-five small">
                                <div class="thumb">
                                    <img class="img-fluid" src="/images/magazine/19.jpg" alt="">
                                </div>
                                <div class="short_details">
                                    <div class="meta-top d-flex">
                                        <a href="#">shoes</a>/
                                        <a href="#">March 15, 2019</a>
                                    </div>
                                    <a class="d-block" href="single-blog.html">
                                        <h4>Shall for rule whoses
                                        may heaven to</h4>
                                    </a>
                                    <div class="meta-bottom d-flex">
                                        <a href="#">March 15, 2019</a>

                                    </div>
                                </div>
                            </div> 
                        </div>

                        <div class="col-lg-6">
                            <div class="single-blog style-five small">
                                <div class="thumb">
                                    <img class="img-fluid" src="/images/magazine/20.jpg" alt="">
                                </div>
                                <div class="short_details">
                                    <div class="meta-top d-flex">
                                        <a href="#">shoes</a>/
                                        <a href="#">March 15, 2019</a>
                                    </div>
                                    <a class="d-block" href="single-blog.html">
                                        <h4>Shall for rule whoses
                                        may heaven to</h4>
                                    </a>
                                    <div class="meta-bottom d-flex">
                                        <a href="#">March 15, 2019</a>

                                    </div>
                                </div>
                            </div> 
                        </div>

                        <div class="col-lg-6">
                            <div class="single-blog style-five small">
                                <div class="thumb">
                                    <img class="img-fluid" src="/images/magazine/21.jpg" alt="">
                                </div>
                                <div class="short_details">
                                    <div class="meta-top d-flex">
                                        <a href="#">shoes</a>/
                                        <a href="#">March 15, 2019</a>
                                    </div>
                                    <a class="d-block" href="single-blog.html">
                                        <h4>Shall for rule whoses
                                        may heaven to</h4>
                                    </a>
                                    <div class="meta-bottom d-flex">
                                        <a href="#">March 15, 2019</a>

                                    </div>
                                </div>
                            </div> 
                        </div>

                        <div class="col-lg-6">
                            <div class="single-blog style-five small">
                                <div class="thumb">
                                    <img class="img-fluid" src="/images/magazine/22.jpg" alt="">
                                </div>
                                <div class="short_details">
                                    <div class="meta-top d-flex">
                                        <a href="#">shoes</a>/
                                        <a href="#">March 15, 2019</a>
                                    </div>
                                    <a class="d-block" href="single-blog.html">
                                        <h4>Shall for rule whoses
                                        may heaven to</h4>
                                    </a>
                                    <div class="meta-bottom d-flex">
                                        <a href="#">March 15, 2019</a>

                                    </div>
                                </div>
                            </div> 
                        </div>          
                    </div>               
                </div> 

            </div>
        </div>
    </div>


    <!--================ Latest Featured section end =================--> 


    <!--================ First block section start =================-->      

    <section class="first_block">
        <div class="container">
            <div class="area-heading">
                <h3>Popular on Blog Sagar (most engaged)  <span> <a href="#" class="b_all genric-btn link-border circle">See All <i class="fa fa-angle-double-right"></i></a> </span></h3>
            </div>
            <div class="row">
                <div class="col-lg-8 col-xl-6">
                    <div class="single-blog row no-gutters style-four border_one">
                        <div class="col-12 col-sm-5">
                            <div class="thumb">
                                <img class="img-fluid" src="/images/magazine/5.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-12 col-sm-7">
                            <div class="short_details">
                                <div class="meta-top d-flex">
                                    <a href="#">Tours & Travel</a>
                                </div>
                                <a class="d-block" href="single-blog.html">
                                    <h4>Brought all day domi
                                        nion appear from
                                        subdue dominion
                                    firmament over face</h4>
                                </a>
                                <div class="meta-bottom d-flex" >
                                    <a href="#">March 12 , 2019 . </a>
                                    <a class="dark_font" href="#">&nbsp; By Bikash Bhandari</a>
                                </div>
                            </div>  
                        </div>  
                    </div>      
                </div>

                <div class="col-lg-4 col-xl-3">
                    <div class="single-blog style_five">
                        <div class="thumb">
                            <img class="img-fluid" src="/images/magazine/6.jpg" alt="">
                        </div>
                        <div class="short_details ">

                            <div class="meta-top d-flex">
                                <a href="#">Tours & Travel</a>
                            </div>
                            <a class="d-block" href="single-blog.html">
                                <h4>Abundantly forth late
                                appear fourth us.</h4>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-xl-3">
                    <div class="single-blog style_five">
                        <div class="thumb">
                            <img class="img-fluid" src="/images/magazine/7.jpg" alt="">
                        </div>
                        <div class="short_details ">

                            <div class="meta-top d-flex">
                                <a href="#">Tours & Travel</a>
                            </div>
                            <a class="d-block" href="single-blog.html">
                                <h4>Abundantly forth late
                                appear fourth us.</h4>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ First block section end =================-->  

    <!--================ Editors Picks section start =================-->  

    <section class="editors_pick area-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="area-heading">
                        <h3>Most Viewed  <span> <a href="#" class="b_all genric-btn link-border circle">See All <i class="fa fa-angle-double-right"></i></a> </span></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @if($mostViewed['0'])
                <div class="col-lg-5 col-xl-6">
                    <div class="single-blog">
                        <div class="thumb">
                            @if($mostViewed['0']->image)
                                 <img class="img-fluid" src="{{ asset('images/blog/'.$mostViewed['0']->image) }}" alt="">
                            @else
                                 <img class="img-fluid" src="{{ asset('images/blog/defaut.jpg') }}" alt="">
                            @endif
                        </div>
                        <div class="short_details pad_25 ">
                            <div class="meta-top d-flex">
                                <a href="#">Tours & Travel</a>
                            </div>
                            <a class="d-block" href="{{ route('blog.detail' , $mostViewed['0']->code)}}">
                                <h4>{{ str_limit($mostViewed['0']->title, $limit = 150, $end = '...') }}</h4>
                            </a>
                            <div class="meta-bottom d-flex" >
                                <a href="#">March 12 , 2019 . </a>
                                <a class="dark_font" href="#">&nbsp; By Bikash Bhandari</a>
                            </div>
                        </div>
                    </div>    
                </div>
                @endif
                <div class="col-lg-7 col-xl-6">
                    @if($mostViewed['1'])
                    <div class="single-blog row no-gutters style-four m_b_30">
                        <div class="col-12 col-sm-7">
                            <div class="short_details padd_left_0">
                                <div class="meta-top d-flex">
                                    <a href="#">Tours & Travel</a>
                                </div>
                                <a class="d-block" href="{{ route('blog.detail' , $mostViewed['1']->code)}}">
                                    <h4 class="font-20">{{ str_limit($mostViewed['1']->title, $limit = 150, $end = '...') }}</h4>
                                </a>
                                <!-- <p>Said spirit evening above good twes at  god midst deep a wherein very made he seas male very broug sad forth saying right.</p> -->
                            </div>  
                        </div>  
                        <div class="col-12 col-sm-5">
                            <div class="thumb">
                                @if($mostViewed['1']->image)
                                 <img class="img-fluid" src="{{ asset('images/blog/'.$mostViewed['1']->image) }}" alt="">
                            @else
                                 <img class="img-fluid" src="{{ asset('images/blog/defaut.jpg') }}" alt="">
                            @endif
                            </div>
                        </div>
                    </div> 
                    @endif
                    @if($mostViewed['2'])
                    <div class="single-blog row no-gutters style-four">
                        <div class="col-12 col-sm-5">
                            <div class="thumb">
                                @if($mostViewed['2']->image)
                                 <img class="img-fluid" src="{{ asset('images/blog/'.$mostViewed['2']->image) }}" alt="">
                            @else
                                 <img class="img-fluid" src="{{ asset('images/blog/defaut.jpg') }}" alt="">
                            @endif
                            </div>
                        </div>
                        <div class="col-12 col-sm-7">
                            <div class="short_details padd_right_0">
                                <div class="meta-top d-flex">
                                    <a href="#">Tours & Travel</a>
                                </div>
                                <a class="d-block" href="{{ route('blog.detail' , $mostViewed['2']->code)}}">
                                    <h4 class="font-20">{{ str_limit($mostViewed['2']->title, $limit = 150, $end = '...') }}</h4>
                                </a>
                                <!-- <p>Said spirit evening above good twes at  god midst deep a wherein very made he seas male very broug sad forth saying right.</p> -->
                            </div>  
                        </div>  
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!--================ Editors Picks section end =================-->      

    <!--================ Video section start =================-->  

    <!-- <div class="video-area background_one area-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="area-heading">
                        <h3>Video Blog title goes here  <span> <a href="#" class="b_all genric-btn link-border circle">See All <i class="fa fa-angle-double-right"></i></a> </span></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <div class="single-blog video-style">
                        <div class="thumb">
                            <img class="img-fluid" src="/images/magazine/11.jpg" alt="">
                            <div class="play_btn">
                                <a class="play-video" href="https://www.youtube.com/watch?v=MrRvX5I8PyY" data-animate="zoomIn"
                                data-duration="1.5s" data-delay="0.1s"><span class="ti-control-play"></span></a>
                            </div>
                        </div>
                        <div class="short_details">
                            <div class="meta-top d-flex">
                                <a href="#">shoes</a>/
                                <a href="#">March 15, 2019</a>
                            </div>
                            <a class="d-block" href="single-blog.html">
                                <h4>Created face stars sixth forth fow
                                Earth firmament meat</h4>
                            </a>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-comment"></i>05 comment</a>
                                <a href="#"><i class="ti-heart"></i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                            </div>
                        </div>
                    </div> 

                </div> 

                <div class="col-lg-5">
                    <div class="single-blog video-style small row m_b_30">
                        <div class="thumb col-12 col-sm-5">
                            <img class="img-fluid" src="/images/magazine/12.jpg" alt="">
                            <div class="play_btn">
                                <a class="play-video" href="https://www.youtube.com/watch?v=MrRvX5I8PyY" data-animate="zoomIn"
                                data-duration="1.5s" data-delay="0.1s"><span class="ti-control-play"></span></a>
                            </div>
                        </div>
                        <div class="short_details col-12 col-sm-7">
                            <div class="meta-top d-flex">
                                <a href="#">Beauty</a>
                            </div>
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#"><i class="ti-heart"></i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                            </div>
                        </div>
                    </div> 

                    <div class="single-blog video-style small row m_b_30 ">
                        <div class="thumb col-12 col-sm-5">
                            <img class="img-fluid" src="/images/magazine/13.jpg" alt="">
                            <div class="play_btn">
                                <a class="play-video" href="https://www.youtube.com/watch?v=MrRvX5I8PyY" data-animate="zoomIn"
                                data-duration="1.5s" data-delay="0.1s"><span class="ti-control-play"></span></a>
                            </div>
                        </div>
                        <div class="short_details col-12 col-sm-7">
                            <div class="meta-top d-flex">
                                <a href="#">Beauty</a>
                            </div>
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#"><i class="ti-heart"></i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                            </div>
                        </div>
                    </div>

                    <div class="single-blog video-style small row">
                        <div class="thumb col-12 col-sm-5">
                            <img class="img-fluid" src="/images/magazine/14.jpg" alt="">
                            <div class="play_btn">
                                <a class="play-video" href="https://www.youtube.com/watch?v=MrRvX5I8PyY" data-animate="zoomIn"
                                data-duration="1.5s" data-delay="0.1s"><span class="ti-control-play"></span></a>
                            </div>
                        </div>
                        <div class="short_details col-12 col-sm-7">
                            <div class="meta-top d-flex">
                                <a href="#">Beauty</a>
                            </div>
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#"><i class="ti-heart"></i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div> -->


    <!--================ Video section end =================-->  


    <!--================ three-block section start =================-->  

    <div class="three-block  area-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="area-heading">
                        <h3>Recent Blogs  <span> <a href="#" class="b_all genric-btn link-border circle">See All Recent Blogs <i class="fa fa-angle-double-right"></i></a> </span></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($latest as $eachLatestBlog)
                <div class="col-lg-4">
                    <div class="single-blog style-five">
                        <div class="thumb">
                            @if($eachLatestBlog->image)
                                 <img class="img-fluid" src="{{ asset('images/blog/'.$eachLatestBlog->image) }}" alt="">
                            @else
                                 <img class="img-fluid" src="{{ asset('images/blog/defaut.jpg') }}" alt="">
                            @endif
                        </div>
                        <div class="short_details">
                            <div class="meta-top d-flex">
                                <a href="#">shoes</a>/
                                <a href="#"><?php echo date("F j, Y",strtotime($eachLatestBlog->created_at) ); ?></a>
                            </div>
                            <a class="d-block" href="{{ route('blog.detail' , $eachLatestBlog->code)}}">
                                <h4>{{ str_limit($eachLatestBlog->title, $limit = 150, $end = '...') }}</h4>
                            </a>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-comment"></i>05 comment</a>
                                <a href="#"><i class="ti-heart"></i> {{$eachLatestBlog->likes_count}} like</a>
                            </div>
                        </div>
                    </div> 

                </div>
                @endforeach 
            </div>
        </div>
    </div>
</div>
@endsection

