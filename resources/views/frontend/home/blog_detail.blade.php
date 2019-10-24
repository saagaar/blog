@extends('frontend.layouts.app')
@section('content')
	<div class="mid_part">
        <!--================Blog Area =================-->
    <section class="blog_area single-post-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list pad-right-0">
                    <div class="white-box single-post">
                        <div class="feature-img">
                            @if($blogDetails->image)
                                 <img class="img-fluid" src="{{ asset('images/blog/'.$blogDetails->image) }}" alt="">
                            @else
                                 <img class="img-fluid" src="{{ asset('images/blog/defaut.jpg') }}" alt="">
                            @endif
                        </div>

                        <div class="blog_details">
                            <h2>{{ $blogDetails->title }}</h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><a href="#"><i class="far fa-user"></i> {{$blogDetails->user->name}}</a></li>
                                <li><icon-comments-count></icon-comments-count></li>
                            </ul>
                            <p class="excert">
                            	{!! $blogDetails->content !!}
                            </p>
                        </div>
                    </div>
                    <div class="white-box  navigation-top">
                        <div class="d-sm-flex justify-content-between text-center">
                            <p class="like-info"><span class="align-middle"><i class="fa fa-heart" aria-hidden="true"></i></span>{{$blogDetails->likes_count}} people like this</p>
                            <div class="col-sm-4 text-center my-2 my-sm-0">
                                <p class="comment-count"><span class="align-middle"><i class="far fa-comment"></i></span> <icon-comments-count></icon-comments-count></p>
                            </div>
                            <ul class="social-icons">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>

                        <div class="navigation-area">
                            <div class="row">
                                @if($prev)
                                <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                    <div class="thumb">
                                        <a href="#">
                                            @if($prev->image)
                                                 <img class="img-fluid" src="{{ asset('images/blog/'.$prev->image) }}" width="60" height="60" alt="">
                                            @else
                                                 <img class="img-fluid" src="{{ asset('images/blog/defaut.jpg') }}"  width="60" height="60" alt="">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="arrow">
                                        <a href="#">
                                            <span class="lnr text-white lnr-arrow-left"></span>
                                        </a>
                                    </div>
                                    <div class="detials">
                                        <p>Prev Post</p>
                                        <a href="#">
                                            <h4>{{ $prev->title }}</h4>
                                        </a>
                                    </div>
                                </div>
                                @endif
                                @if($next)
                                <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                    <div class="detials">
                                        <p>Next Post</p>
                                        <a href="#">
                                            <h4>{{ $next->title }}</h4>
                                        </a>
                                    </div>
                                    <div class="arrow">
                                        <a href="#">
                                            <span class="lnr text-white lnr-arrow-right"></span>
                                        </a>
                                    </div>
                                    <div class="thumb">
                                        <a href="#">
                                            @if($next->image)
                                                 <img class="img-fluid" src="{{ asset('images/blog/'.$next->image) }}"  width="60" height="60" alt="">
                                            @else
                                                 <img class="img-fluid" src="{{ asset('images/blog/defaut.jpg') }}"  width="60" height="60" alt="">
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>


                    <!-- <div class="blog-author white-box">
                        <div class="media align-items-center">
                            <img src="img/blog/author.png" alt="">
                            <div class="media-body">
                                <a href="#">
                                    <h4>Sagar Chapagain</h4>
                                </a>
                                <p>Second divided from form fish beast made. Every of seas all gathered use saying you're, he our dominion twon Second divided from</p>
                            </div>
                        </div>
                    </div> -->
                    <comment v-bind:blog="{{ $blogDetails }}" :allComment="{{ $blogComment }}"></comment>
                    <!-- <div class="comments-area white-box">
                        <h4>{{ $blogDetails->comments_count}} Comments</h4>
                        <list-comment  v-bind:allComment="{{ $blogComment }}"></list-comment>
                    </div>
                    <add-comment v-bind:blog="{{ $blogDetails }}"></add-comment> -->
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">

                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title"><i class="fa fa-star">&nbsp;</i> Category</h4>
                            <ul class="list cat-list">
                                <li>
                                    <a href="#">
                                        <span>Resaurant food</span>
                                        <span>(37)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>Travel news</span>
                                        <span>(10)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>Modern technology</span>
                                        <span>(03)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>Product</span>
                                        <span>(11)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>Inspiration</span>
                                        <span>(21)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>Health Care</span>
                                        <span>(21)</span>
                                    </a>
                                </li>
                            </ul>
                        </aside>

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title"><i class="fa fa-star">&nbsp;</i> Recent Post</h3>
                            <div class="media post_item">
                                <img src="img/blog/popular-post/post1.jpg" alt="post">
                                <div class="media-body">
                                    <a href="single-blog.html">
                                        <h3>From life was you fish...</h3>
                                    </a>
                                    <p>January 12, 2019</p>
                                </div>
                            </div>
                            <div class="media post_item">
                                <img src="img/blog/popular-post/post2.jpg" alt="post">                              
                                <div class="media-body">
                                    <a href="single-blog.html">
                                        <h3>The Amazing Hubble</h3>
                                    </a>
                                    <p>02 Hours ago</p>
                                </div>
                            </div>
                            <div class="media post_item">
                                <img src="img/blog/popular-post/post3.jpg" alt="post">                              
                                <div class="media-body">
                                    <a href="single-blog.html">
                                        <h3>Astronomy Or Astrology</h3>
                                    </a>
                                    <p>03 Hours ago</p>
                                </div>
                            </div>
                            <div class="media post_item">
                                <img src="img/blog/popular-post/post4.jpg" alt="post">
                                <div class="media-body">
                                    <a href="single-blog.html">
                                        <h3>Asteroids telescope</h3>
                                    </a>
                                    <p>01 Hours ago</p>
                                </div>
                            </div>
                        </aside>
                        <aside class="single_sidebar_widget tag_cloud_widget">
                            <h4 class="widget_title"><i class="fa fa-star">&nbsp;</i> Tag Clouds</h4>
                            <ul class="list">
                            	@foreach($blogDetails->tags as $eachTags)
                                <li>
                                    <a href="#">{{ $eachTags->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </aside>


                        <aside class="single_sidebar_widget instagram_feeds">
                            <h4 class="widget_title"><i class="fa fa-star">&nbsp;</i> Instagram Feeds</h4>
                            <ul class="instagram_row flex-wrap">
                                <li>
                                    <a href="#">
                                        <img class="img-fluid" src="img/instagram/widget-i1.png" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="img-fluid" src="img/instagram/widget-i2.png" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="img-fluid" src="img/instagram/widget-i3.png" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="img-fluid" src="img/instagram/widget-i4.png" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="img-fluid" src="img/instagram/widget-i5.png" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="img-fluid" src="img/instagram/widget-i6.png" alt="">
                                    </a>
                                </li>
                            </ul>
                        </aside>


                        <aside class="single_sidebar_widget newsletter_widget">
                            <h4 class="widget_title"><i class="fa fa-star">&nbsp;</i> Newsletter</h4>

                            <form action="#">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Enter email" required>
                                </div>
                                <button class="button primary-bg text-white w-100 btn-round" type="submit">Subscribe</button>
                            </form>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area end =================-->
    <div class="clearfix"></div>
</div>
@endsection