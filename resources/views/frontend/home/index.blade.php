@extends('frontend.layouts.app')
@section('content')
 
<section class="fullwidth-block area-padding-bottom">


 <div class="spinner-border text-primary" role="status">
  <span class="sr-only">Loading...</span>
</div>
 @if(count($featuredBlog) >=4)
 <!--================Fullwidth block Area =================-->
    <section class="fullwidth-block area-padding-bottom area-padding-top">
        <div class="container"> 
            
            <div class="row">
            	@if($featuredBlog['0'])
                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style big">
                        <div class="thumb bg-color">
                            <a>
                            @if($featuredBlog['0']->image)
                                 <img class="img-fluid plain-bg" data-src="{{ asset('uploads/blog/'.$featuredBlog['0']->code.'/'.$featuredBlog[0]->image) }}" alt="">
                            @else
                                 <img class="img-fluid" src="{{ asset('/frontend/images/elements/default-post.jpg') }}" alt="">
                            @endif
                            </a>
                        </div>
                        <div class="short_details">
                             <div class="meta-top d-flex">
                            @php
                          echo   ($featuredBlog['0']->anynomous=='2') ? (isset($featuredBlog['0']->user->name)  ? '<a href="/profile/'.$featuredBlog['0']->user->username.'">By '. $featuredBlog['0']->user->name.'</a>' : '<a >Admin</a>'):'<a > Anynomous </a>'
                            @endphp
                            </div>
                            <a class="d-block"  href="{{ route('blog.detail' ,[$featuredBlog['0']->code,str_slug($featuredBlog['0']->title)])}}">
                                <h4>{{ str_limit($featuredBlog['0']->title, $limit = 150, $end = '...') }}</h4>
                            </a>
                            <p>
                               {{ str_limit($featuredBlog['0']->short_description, $limit = 150, $end = '...') }}
                            </p>
                            <div class="meta-bottom d-flex">
                                <a ><i class="ti-time"></i>&nbsp;{{ $featuredBlog['0']->created_at->diffForHumans() }} </a>
                                <a  class="appreciate"><i>
                                @if(auth()->user())
                                    @if(in_array($featuredBlog['0']->id,$likes->toArray()))
                                        <img src="/frontend/images/elements/appreciate.png" width="25" height="25" class="img-fluid">
                                    @else
                                        <img src="/frontend/images/elements/inactive-appreciate.png" width="25" height="25" class="img-fluid">
                                    @endif
                                @else
                                
                                    <img src="/frontend/images/elements/inactive-appreciate.png" width="25" height="25" class="img-fluid">
                                @endif
                                </i>&nbsp;&nbsp;{{$featuredBlog['0']->likes_count }} like</a>
                                <a ><i class="ti-eye"></i>&nbsp;{{$featuredBlog['0']->views }} view</a>
                                
                                @if(auth()->user())
                                <save-blog :isLoggedIn="true" :blogcode="'{{$featuredBlog['0']->code}}'" v-bind:saves="{{ $savedBlog }}"></save-blog>
                                @endif
                             <!--    <a  class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a> -->
                        </div>
                    </div>
                </div> 

                </div> 
                @endif
               
                <?php unset($featuredBlog['0']); ?>
               
                <div class="col-lg-6 col-md-6">
                	@foreach($featuredBlog as $eachFeaturedBlog)
                    <div class="single-blog video-style small row m_b_30">
                        <div class="thumb col-md-4 col-sm-5 col-12 bg-color">
                            <figure>
                                <a >

                            @if($eachFeaturedBlog->image)
                                    @php

                                        $img=explode('.',$eachFeaturedBlog->image);
                                    @endphp
                                 <img class="img-fluid plain-bg" data-src="{{ asset('uploads/blog/'.$eachFeaturedBlog->code.'/'.$img[0].'-thumbnail.'.$img[1]) }}" alt="">
                            @else
                                 <img class="img-fluid" src="{{ asset('frontend/images/elements/default-post.jpg') }}" alt="">

                            @endif
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                             <div class="meta-top d-flex">
                           @php
                                echo   ($eachFeaturedBlog->anynomous=='2') ? (isset($eachFeaturedBlog->user->name)  ? '<a href="/profile/'.$eachFeaturedBlog->user->username.'"> By '.$eachFeaturedBlog->user->name.'</a>' : '<a >By Admin</a>'):'<a >By  Anynomous </a>'
                            @endphp
                            </div>
                            <a class="d-block"  href="{{ route('blog.detail' , [$eachFeaturedBlog->code,str_slug($eachFeaturedBlog->title)] )}}">
                                <h4>{{ str_limit($eachFeaturedBlog->title, $limit = 150, $end = '...') }}</h4>
                            </a>
                            <p>{{ str_limit($eachFeaturedBlog->short_description, $limit = 150, $end = '...') }}</p>
                            <div class="meta-bottom d-flex">
                                <a ><i class="ti-time"></i>&nbsp;{{ $eachFeaturedBlog->created_at->diffForHumans() }}</a>
                                <a  class="appreciate"><i>
                                    @if(auth()->user())
                                        @if(in_array($eachFeaturedBlog->id,$likes->toArray()))
                                            <img src="/frontend/images/elements/appreciate.png" width="25" height="25" class="img-fluid">
                                        @else
                                            <img src="/frontend/images/elements/inactive-appreciate.png" width="25" height="25" class="img-fluid">
                                        @endif
                                    @else
                                    
                                        <img src="/frontend/images/elements/inactive-appreciate.png" width="25" height="25" class="img-fluid">
                                    @endif
                                </i>&nbsp; &nbsp;{{$eachFeaturedBlog->likes_count }} like</a>
                                <a ><i class="ti-eye"></i>&nbsp;{{$eachFeaturedBlog->views }} view</a>
                                @if(auth()->user())
                                <save-blog :isLoggedIn="true" :blogcode="'{{$eachFeaturedBlog->code}}'" v-bind:saves="{{ $savedBlog }}"></save-blog>
                                @endif
                               <!--  <a  class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a> -->
                            </div>
                        </div>
                    </div> 
                    @endforeach
                    

                    <div class="text-right">
                        <a href="{{ route('bloglistbyslug' , 'all-featured')}}" class="b_all genric-btn link-border circle">See All <i class="fa fa-angle-double-right"></i></a>
                    </div>

                </div>
            </div>
           
        </div>
    </section>
    {{--
    Section when blog count is less then 4
    --}}
 @else
 <section class="hero-section" id="home" style="background-image: url(landing-page/assets/images/hero-area/banner-bg.png);">
  <div class="container">
    <div class="row">
    
         <div class="col-lg-12 text-center">        
        <h1 class="mb-3">It's So easy to get started</h1>
        <p class="mb-4"> </p>
        @if(\Auth::check()):
        <a href="/blog/add" class="btn btn-secondary btn-lg mb-5">Create a post</a>
        @else
        <login-button class="btn btn-secondary btn-lg mb-5"></login-button>
        <!-- <a href="/blog/add" class="btn btn-secondary btn-lg mb-5">Login</a> -->
        @endif

         <h2 class="section-title">Share your story to the world.</h2>
        <p class="mb-4"> <b style="font-weight: 300px">One</b> small story has potential to change  <b style="font-weight: 300px">Millions </b> of people.</p>
        <!-- banner image -->
        <h4> Select one of 100s topics you are enthusiast about!!</h4>
         <newsletter></newsletter>
         <div class="clearfix"></div>
      </div>
      <!-- <img class="img-fluid" src="landing-page/assets/images/hero-area/banner.png" alt="banner-img">    -->
    </div>
  </div>
</section>
<section class="section-lg seo" id="about-us">
  <div class="container">
    <div class="row"> 
        <div class=" col-md-8 offset-md-2 offset-md-2 order-2 order-md-1">
       
     
        <!-- <p> It is easy to use and manage your blog without any specific technical skills. You can reach an existing online community of people with similar interests and build a fan base.</p> -->
      </div>
     
    </div>
  </div>
  <!-- background image -->
  
  <!-- background-shape -->
  <img class="seo-bg-shape-1" src="landing-page/assets/images/background-shape/seo-ball-1.png" alt="bg-shape">
  <img class="seo-bg-shape-2" src="landing-page/assets/images/background-shape/seo-half-cycle.png" alt="bg-shape">
  <img class="seo-bg-shape-3" src="landing-page/assets/images/background-shape/seo-ball-2.png" alt="bg-shape">
</section>
 @endif


    <!--================Fullwidth block Area end =================-->

    <!--================ Latest Featured section start =================-->  
 @if(count($featuredForMember)>4)
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
                    <div class="single-blog video-style big">
                        <div class="thumb bg-color">
                            <a >
                                @php
                                    $img=explode('.',$featuredForMember['0']->image);
                                @endphp
                                @if($featuredForMember['0']->image)
                                 <img class="img-fluid plain-bg" data-src="{{ asset('uploads/blog/'.$featuredForMember['0']->code.'/'.$featuredForMember[0]->image) }}" alt="">
                                @else
                                 <img class="img-fluid" src="{{ asset('frontend/images/elements/default-post.jpg') }}" alt="">

                            @endif
                            </a>
                        </div>
                        <div class="short_details">
                             <div class="meta-top d-flex">
                            @php
                                echo   ($featuredForMember['0']->anynomous=='2') ? (isset($featuredForMember['0']->user->name)  ? '<a href="/profile/'.$featuredForMember[0]->user->username.'"> By '.$featuredForMember['0']->user->name.'</a>' : '<a >By Admin</a>'):'<a >By  Anynomous </a>'
                            @endphp
                            </div>
                            <a class="d-block"  href="{{ route('blog.detail' ,  [$featuredForMember['0']->code,str_slug($featuredForMember['0']->title)] )}}">
                                <h4>{{ str_limit($featuredForMember['0']->title, $limit = 150, $end = '...') }}</h4>
                            </a>
                            <p>
                               {{str_limit($featuredForMember['0']->short_description, $limit = 150, $end = '...') }}
                            </p>
                            <div class="meta-bottom d-flex">
                                <a ><i class="ti-time"></i>&nbsp;{{ $featuredForMember['0']->created_at->diffForHumans() }} </a>
                                <a  class="appreciate"><i>
                                    @if(auth()->user())
                                        @if(in_array($featuredForMember['0']->id,$likes->toArray()))
                                            <img src="/frontend/images/elements/appreciate.png" width="25" height="25" class="img-fluid">
                                        @else
                                            <img src="/frontend/images/elements/inactive-appreciate.png" width="25" height="25" class="img-fluid">
                                        @endif
                                    @else
                                    
                                        <img src="/frontend/images/elements/inactive-appreciate.png" width="25" height="25" class="img-fluid">
                                    @endif
                                </i>&nbsp;{{$featuredForMember['0']->likes_count }} like</a>
                                <a ><i class="ti-eye"></i>&nbsp;{{$featuredForMember['0']->views }} view</a>
                                @if(auth()->user())
                                <save-blog :isLoggedIn="true" :blogcode="'{{$featuredForMember['0']->code}}'" v-bind:saves="{{ $savedBlog }}"></save-blog>
                                @endif
                               <!--  <a  class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a> -->
                            </div>
                        </div>
                    </div> 
                </div> 
                @endif
                
                <?php unset($featuredForMember['0']); ?>
                
                <div class="col-lg-6 col-md-6">
                    @foreach($featuredForMember as $eachFeaturedForMember)
                    <div class="single-blog video-style small row m_b_30">
                        <div class="thumb col-md-4 col-sm-5 col-12 bg-color">
                            <figure>
                                <a >
                                 
                            @if($eachFeaturedForMember->image)
                                @php
                                    $img=array();
                                    $img=explode('.',$eachFeaturedForMember->image);
                                @endphp
                                 <img class="img-fluid plain-bg" data-src="{{ asset('uploads/blog/'.$eachFeaturedForMember->code.'/'.$img[0].'-thumbnail.'.$img[1]) }}" alt="">
                            @else
                                 <img class="img-fluid" src="{{ asset('frontend/images/elements/default-post.jpg') }}" alt="">

                            @endif
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <div class="meta-top d-flex">
                                @php
                                    echo   ($eachFeaturedForMember->anynomous=='2') ? (isset($eachFeaturedForMember->user->name)  ? '<a href="/profile/'.$eachFeaturedForMember->user->username.'"> By '.$eachFeaturedForMember->user->name.'</a>' : '<a >By Admin</a>'):'<a >By  Anynomous </a>'
                            @endphp
                            </div>
                            <a class="d-block"  href="{{ route('blog.detail' ,  [$eachFeaturedForMember->code,str_slug($eachFeaturedForMember->title)] )}}">
                                <h4>{{ str_limit($eachFeaturedForMember->title, $limit = 150, $end = '...') }}</h4>
                            </a>
                            <p>{{ str_limit($eachFeaturedForMember->short_description, $limit = 150, $end = '...') }}</p>
                            <div class="meta-bottom d-flex">
                                <a ><i class="ti-time"></i>&nbsp;{{ $eachFeaturedForMember->created_at->diffForHumans() }} </a>
                                <a  class="appreciate"><i>
                                    @if(auth()->user())
                                        @if(in_array($eachFeaturedForMember->id,$likes->toArray()))
                                            <img src="/frontend/images/elements/appreciate.png" width="25" height="25" class="img-fluid">
                                        @else
                                            <img src="/frontend/images/elements/inactive-appreciate.png" width="25" height="25" class="img-fluid">
                                        @endif
                                    @else
                                    
                                        <img src="/frontend/images/elements/inactive-appreciate.png" width="25" height="25" class="img-fluid">
                                    @endif
                                &nbsp;</i>{{$eachFeaturedForMember->likes_count }} like</a>
                                <a ><i class="ti-eye"></i>&nbsp;{{$eachFeaturedForMember->views }} view</a>
                                @if(auth()->user())
                                <save-blog :isLoggedIn="true" :blogcode="'{{$eachFeaturedForMember->code}}'" v-bind:saves="{{ $savedBlog }}"></save-blog>
                                @endif
                             <!--    <a  class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a> -->
                            </div>
                        </div>
                    </div> 
                    @endforeach

                    <div class="text-right">
                        <a href="{{ route('bloglistbyslug' , 'featured-for-member')}}" class="b_all genric-btn link-border circle">See All <i class="fa fa-angle-double-right"></i></a>
                    </div>

                </div>
            </div>

        </div>
    </div>
             @endif


    <!--================ Latest Featured section end =================--> 

 @if(count($popular) == 4)
    <!--================ First block section start =================-->      
    <section class="first_block area-padding-top area-padding-bottom">
        <div class="container">
            <div class="area-heading">
                <h3>Popular</h3>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style big">
                        <div class="thumb bg-color">
                            <a>
                           
                            @if($popular['0']->image)
                                 <img class="img-fluid plain-bg" data-src="{{ asset('uploads/blog/'.$popular['0']->code.'/'.$popular['0']->image) }}" alt="">
                            @else
                                 <img class="img-fluid" src="{{ asset('frontend/images/elements/default-post.jpg') }}" alt="">

                            @endif
                            </a>
                        </div>
                        <div class="short_details">
                          <div class="meta-top d-flex">
                            @php
                                echo   ($popular['0']->anynomous=='2') ? (isset($popular['0']->user->name)  ? '<a href="/profile/'.$popular[0]->user->username.'"> By '.$popular['0']->user->name.'</a>' : '<a >By Admin</a>'):'<a >By  Anynomous </a>'
                            @endphp
                           </div>
                            <a class="d-block"  href="{{ route('blog.detail' , [$popular[0]->code,str_slug($popular[0]->title)] )}}">
                                <h4>{{ str_limit($popular['0']->title, $limit = 150, $end = '...') }}</h4>
                            </a>
                            <p>
                               {{ str_limit($popular['0']->short_description, $limit = 150, $end = '...') }}
                            </p>
                            <div class="meta-bottom d-flex">
                                <a ><i class="ti-time"></i>&nbsp;{{ $popular['0']->created_at->diffForHumans() }} </a>
                                <a  class="appreciate"><i>
                                    @if(auth()->user())
                                        @if(in_array($popular['0']->id,$likes->toArray()))
                                            <img src="/frontend/images/elements/appreciate.png" width="25" height="25" class="img-fluid">
                                        @else
                                            <img src="/frontend/images/elements/inactive-appreciate.png" width="25" height="25" class="img-fluid">
                                        @endif
                                    @else
                                    
                                        <img src="/frontend/images/elements/inactive-appreciate.png" width="25" height="25" class="img-fluid">
                                    @endif
                                &nbsp;</i>{{$popular['0']->likes_count }} like</a>
                                <a ><i class="ti-eye"></i>&nbsp;{{$popular['0']->views }} view</a>
                                @if(auth()->user())
                                <save-blog :isLoggedIn="true" :blogcode="'{{$popular['0']->code}}'" v-bind:saves="{{ $savedBlog }}"></save-blog>
                                @endif
                               <!--  <a  class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a> -->
                            </div>
                        </div>
                    </div> 

                </div> 
                <?php unset($popular['0']); 

                ?>
                @if(count($popular)>0)
                <div class="col-lg-6 col-md-6">
                	@foreach($popular as $eachPopular)
                    <div class="single-blog video-style small row m_b_30">
                        <div class="thumb col-md-4 col-sm-5 col-12 bg-color bg-color">
                            <figure>
                                    
                                <a >
                            @if($eachPopular->image)
                                     @php
                                        $img=explode('.',$eachPopular->image);
                                    @endphp
                                 <img class="img-fluid plain-bg" data-src="{{ asset('uploads/blog/'.$eachPopular->code.'/'.$img[0].'-thumbnail.'.$img[1]) }}" alt="">
                            @else
                                 <img class="img-fluid" src="{{ asset('frontend/images/elements/default-post.jpg') }}" alt="">

                            @endif
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">

                           <div class="meta-top d-flex">
                            @php
                                    echo   ($eachPopular->anynomous=='2') ? (isset($eachPopular->user->name)  ? '<a href="/profile/'.$eachPopular->user->username.'"> By '.$eachPopular->user->name.'</a>' : '<a >By Admin</a>'):'<a >By  Anynomous </a>'
                            @endphp
                            </div>
                            <a class="d-block"  href="{{ route('blog.detail' , [$eachPopular->code,str_slug($eachPopular->title)])}}">
                                <h4>{{ str_limit($eachPopular->title, $limit = 150, $end = '...') }}</h4>
                            </a>
                            <p>{{ str_limit($eachPopular->short_description, $limit = 150, $end = '...') }}</p>
                            <div class="meta-bottom d-flex">
                                <a ><i class="ti-time"></i>&nbsp;
                                {{ $eachPopular->created_at->diffForHumans() }} </a>
                                <a  class="appreciate"><i>
                                    @if(auth()->user())
                                        @if(in_array($eachPopular->id,$likes->toArray()))
                                            <img src="/frontend/images/elements/appreciate.png" width="25" height="25" class="img-fluid">
                                        @else
                                            <img src="/frontend/images/elements/inactive-appreciate.png" width="25" height="25" class="img-fluid">
                                        @endif
                                    @else
                                    
                                        <img src="/frontend/images/elements/inactive-appreciate.png" width="25" height="25" class="img-fluid">
                                    @endif
                                &nbsp;</i>{{$eachPopular->likes_count }} like</a>
                                <a ><i class="ti-eye"></i>&nbsp;{{$eachPopular->views }} view</a>
                                @if(auth()->user())
                                <save-blog :isLoggedIn="true" :blogcode="'{{$eachPopular->code}}'" v-bind:saves="{{ $savedBlog }}"></save-blog>
                                @endif
                                <!-- <a  class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a> -->
                            </div>
                        </div>
                    </div> 
                    @endforeach
                    

                    <div class="text-right">
                        <a href="{{ route('bloglistbyslug' , 'popular')}}" class="b_all genric-btn link-border circle">See All <i class="fa fa-angle-double-right"></i></a>
                    </div>

                </div>
                @endif
            </div>
        </div>
    </section>
                @endif

    <!--================ First block section end =================-->       

    @if(count($latest) >= 2)
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
                        <div class="thumb col-md-4 col-sm-5 col-12 bg-color">
                            <figure>
                                <a >

                                @if($eachLatest->image)
                                     @php
                                        $img=explode('.',$eachLatest->image);
                                    @endphp
	                                <img class="img-fluid plain-bg" data-src="{{ asset('uploads/blog/'.$eachLatest->code.'/'.$img[0].'-thumbnail.'.$img[1]) }}" alt="">
	                            @else
	                                <img class="img-fluid" src="{{ asset('frontend/images/elements/default-post.jpg') }}" alt="">

	                            @endif
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                          <div class="meta-top d-flex">
                            @php
                                echo   ($eachLatest->anynomous=='2') ? (isset($eachLatest->user->name)  ? '<a href="/profile/'.$eachLatest->user->username.'"> By '.$eachLatest->user->name.'</a>' : '<a >By Admin</a>'):'<a >By  Anynomous </a>'
                            @endphp
                            </div>
                            <a class="d-block"  href="{{ route('blog.detail' , [$eachLatest->code,str_slug($eachLatest->title)])}}">
                                <h4>{{ str_limit($eachLatest->title, $limit = 150, $end = '...') }}</h4>
                            </a>
                            <p>{{ str_limit($eachLatest->short_description, $limit = 150, $end = '...') }}</p>
                            <div class="meta-bottom d-flex">
                                <a ><i class="ti-time"></i>&nbsp;
                                {{ $eachLatest->created_at->diffForHumans() }} </a>
                                <a  class="appreciate"><i>
                                    @if(auth()->user())
                                        @if(in_array($eachLatest->id,$likes->toArray()))
                                            <img src="/frontend/images/elements/appreciate.png" width="25" height="25" class="img-fluid">
                                        @else
                                            <img src="/frontend/images/elements/inactive-appreciate.png" width="25" height="25" class="img-fluid">
                                        @endif
                                    @else
                                    
                                        <img src="/frontend/images/elements/inactive-appreciate.png" width="25" height="25" class="img-fluid">
                                    @endif
                                &nbsp;</i>{{$eachLatest->likes_count }} like</a>
                                <a ><i class="ti-eye"></i>{{$eachLatest->views }} view</a>
                                @if(auth()->user())
                                <save-blog :isLoggedIn="true"  :blogcode="'{{$eachLatest->code}}'" v-bind:saves="{{ $savedBlog }}"></save-blog>
                                @endif
                               <!--  <a  class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
             
                <div class="col-md-12">
                 @if(auth()->user())
                <latest-blog-loading v-bind:is-logged-in="true" v-bind:saves="{{$savedBlog}}" v-bind:userliked="{{$userLiked}}"></latest-blog-loading>
                @else
                    <latest-blog-loading></latest-blog-loading>
                @endif
                </div>
            </div>
        </div>
    </div>
       @endif
    <!--================ three-block section end =================-->  
@endsection