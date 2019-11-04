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
                                <a href="#"><i class="ti-time"></i><?php echo date("F j",strtotime($featuredBlog['0']->created_at) ); ?> </a>
                                <a href="#" class="appreciate"><i>
                                    <img src="images/appreciate-active.gif" width="25" height="25" class="img-fluid">
                                </i> {{$featuredBlog['0']->likes_count }} like</a>
                                <a href="#"><i class="ti-eye"></i> {{$featuredBlog['0']->views }} view</a>
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
                                <a href="#"><i class="ti-time"></i><?php echo date("F j",strtotime($eachFeaturedBlog->created_at) ); ?> </a>
                                <a href="#" class="appreciate"><i>
                                    <img src="images/appreciate-active.gif" width="25" height="25" class="img-fluid">
                                </i> {{$eachFeaturedBlog->likes_count }} like</a>
                                <a href="#"><i class="ti-eye"></i> {{$eachFeaturedBlog->views }} view</a>
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
                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style">
                        <div class="thumb">
                            <a href="#">
                                <img class="img-fluid" src="img/magazine/18.jpg" alt="">
                            </a>
                        </div>
                        <div class="short_details">
                            <a class="d-block" href="single-blog.html">
                                <h4>Created face stars sixth forth fow
                                Earth firmament meat</h4>
                            </a>
                            <p>
                               The idea that the Big Bang happened everywhere at once may apply to our Universe, but certainly ought not to apply to the vast majority of Universes existing in the Multiverse. Assuming that inflation is a quantum field, like all fields we know of, it must spread out over time, meaning that in any region of space, it has a probability of...
                            </p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div> 

                </div> 

                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row m_b_30">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/6.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div> 

                    <div class="single-blog video-style small row m_b_30 ">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/5.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>

                    <div class="single-blog video-style small row">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/7.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>

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
                <h3>Popular on Blog Sagar</h3>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style">
                        <div class="thumb">
                            <a href="#">
                                <img class="img-fluid" src="img/magazine/8.jpg" alt="">
                            </a>
                        </div>
                        <div class="short_details">
                            <a class="d-block" href="single-blog.html">
                                <h4>Created face stars sixth forth fow
                                Earth firmament meat</h4>
                            </a>
                            <p>
                               The idea that the Big Bang happened everywhere at once may apply to our Universe, but certainly ought not to apply to the vast majority of Universes existing in the Multiverse. Assuming that inflation is a quantum field, like all fields we know of, it must spread out over time, meaning that in any region of space, it has a probability of...
                            </p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div> 

                </div> 

                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row m_b_30">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/9.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div> 

                    <div class="single-blog video-style small row m_b_30 ">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/10.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>

                    <div class="single-blog video-style small row">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/14.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>

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
                        <h3>Featured Collections</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row m_b_30">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/12.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row m_b_30 ">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/13.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/14.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row m_b_30">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/15.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row m_b_30 ">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/16.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/17.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row m_b_30">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/18.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row m_b_30 ">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/19.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/20.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row m_b_30">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/21.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row m_b_30 ">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/22.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/2.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row m_b_30">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/15.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row m_b_30 ">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/16.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/17.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row m_b_30">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/15.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row m_b_30 ">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/16.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-blog video-style small row">
                        <div class="thumb col-md-4 col-sm-5 col-12">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="img/magazine/17.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="short_details col-md-8 col-sm-7 col-12">
                            <a class="d-block" href="single-blog.html">
                                <h4>Blessed night morning on
                                them you great</h4>
                            </a>
                            <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part...</p>
                            <div class="meta-bottom d-flex">
                                <a href="#"><i class="ti-time"></i>mar 12</a>
                                <a href="#" class="appreciate"><i>
                                    <img src="img/appreciate-active.gif" class="img-fluid">
                                </i> 0 like</a>
                                <a href="#"><i class="ti-eye"></i> 1k view</a>
                                <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================ three-block section end =================-->  
@endsection