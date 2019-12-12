@extends('frontend.layouts.app')
@section('content')
	<div class="mid_part">
        @section('meta_url','https://thebloggersclub.com/blog/detail/{{ $blogDetails->code }}')
        @section('meta_title',$blogDetails->title)
        @section('meta_title',$blogDetails->title)
        @section('meta_description',$blogDetails->short_description)
        @section('meta_image',asset('/uploads/blog/'.$blogDetails->code.'/'.$blogDetails->image))
        <meta type="hidden" name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
        <!--================Blog Area =================-->
    <section class="blog_area single-post-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list pad-right-0">
                    <div class="white-box single-post">
                        <div class="feature-img">
                            @if($blogDetails->image)
                                  <!-- <img class="img-fluid " src="{{ asset('/uploads/blog/'.$blogDetails->code.'/'.$blogDetails->image) }}"  alt=""> -->

                                   <img class="img-fluid  image-placeholder blur" src="{{ '/image/'.$blogDetails->code.'/10/'.$blogDetails->image }}" data-src="{{ '/image/'.$blogDetails->code.'/500/'.$blogDetails->image }}" alt="" style="min-width: 100%">

                            @else
                                 <img class="img-fluid" src="{{ asset('/frontend/images/elements/default-post.jpg') }}" alt="">

                            @endif
                        </div>
                        <div class="blog_details">
                            <h2>{{ $blogDetails->title }}</h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><a href="#"><i class="far fa-user"></i> {{ (isset($blogDetails->user)) ? $blogDetails->user->name: 'Admin' }}</a></li>
                                <li><icon-comments-count></icon-comments-count></li>
                            </ul>
                            <p class="excert">
                            	{!! $blogDetails->content !!}
                            </p>
                        </div>
                    </div>
                    <div class="white-box  navigation-top">
                        <div class="d-sm-flex justify-content-between text-center">
                            <p class="like-info"><span class="align-middle">
                                @if($likes)
                                <likes v-bind:currentblog="{{$blogDetails}}" :blogid="{{$blogDetails->id}}" :blogCode="'{{$blogDetails->code}}'" :likes="{{$likes}}"></likes>
                                @else
                                    <img src="/frontend/images/elements/inactive-appreciate.png" width="25" height="25" class="img-fluid"><span>{{ $blogDetails->likes_count }} people Appreciate this</span>
                                @endif
                            <!-- </span>{{$blogDetails->likes_count}} people like this</p> -->
                            <div class="col-sm-4 text-center my-2 my-sm-0">
                                <p class="comment-count"><span class="align-middle"></span> <icon-comments-count></icon-comments-count></p>
                            </div>
                            <ul class="social-icons">
                                @php($url=url('https://thebloggersclub.com/blog/detail/'.$blogDetails->code))
                    
                                <fb-share :url="'{{$url}}'" :blog="{{$blogDetails}}"></fb-share>
                                <tw-share :url="'{{$url}}'" :blog="{{$blogDetails}}"></tw-share>    
                                <!-- <li><a href="#"><i class="fab fa-facebook-f"></i></a></li> -->
                                <!-- <li><a href="{{url('https://twitter.com/intent/tweet?url='.$url.'&text='.$blogDetails->title)}}"><i class="fab fa-twitter"></i></a></li> -->
                                <!-- <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li> -->
                            </ul>
                        </div>

                        <div class="navigation-area">
                            <div class="row">
                                
                                <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                    @if($prev)
                                    <div class="thumb">
                                        <a href="#">
                                            @if($prev->image)
                                                 <img class="img-fluid" src="{{ asset('uploads/blog/'.$prev->code.'/'.$prev->image) }}" width="60" height="60" alt="">
                                            @else
                                                 <img class="img-fluid" src="{{ asset('frontend/images/elements/default-post.jpg') }}"  width="60" height="60" alt="">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="arrow">
                                        <a href="#">
                                            <span class="lnr text-white lnr-arrow-left"></span>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <p>Prev Post</p>
                                        <a href="#">
                                            <h4>{{ $prev->title }}</h4>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                                
                                
                                <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                    @if($next)
                                    <div class="details">
                                        <p>Next Post</p>
                                        <a href="{{ route('blog.detail' , $next->code)}}">
                                            <h4>{{ $next->title }}</h4>
                                        </a>
                                    </div>
                                    <div class="arrow">
                                        <a href="{{ route('blog.detail' , $next->code)}}">
                                            <span class="lnr text-white lnr-arrow-right"></span>
                                        </a>
                                    </div>
                                    <div class="thumb">
                                        <a href="{{ route('blog.detail' , $next->code)}}">
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                                
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
                    @if(!auth()->user())
                    <div class="area-padding">
                    <div class="d-flex justify-content-center text-center">
                                <p class="comment-count"><span class="align-middle"></span>Please <login-button></login-button> to comment</p>
                            </div>
                    </div>
                    @endif
                    <!-- <div class="comments-area white-box">
                        <h4>{{ $blogDetails->comments_count}} Comments</h4>
                        <list-comment  v-bind:allComment="{{ $blogComment }}"></list-comment>
                    </div>
                    <add-comment v-bind:blog="{{ $blogDetails }}"></add-comment> -->
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">

                        <!-- <aside class="single_sidebar_widget post_category_widget">
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
                        </aside> -->

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title"><i class="fa fa-star">&nbsp;</i> Related Post</h3>
                            @foreach($relatedBlog as $eachRelatedBlog)
                            <div class="media post_item">
                                @if($eachRelatedBlog->image)
                                     <img src="{{ asset('uploads/blog/'.$eachRelatedBlog->code.'/'.$eachRelatedBlog->image) }}" width="60" height="60" alt="">
                                @else
                                     <img src="{{ asset('frontend/images/elements/default-post.jpg') }}" width="60" height="60" alt="">

                                @endif
                                <div class="media-body">
                                    <a href="{{ route('blog.detail' , $eachRelatedBlog->code)}}">
                                        <h3>{{ str_limit($eachRelatedBlog->title, $limit = 25, $end = '...') }}</h3>
                                    </a>
                                    <p>January 12, 2019</p>
                                </div>
                            </div>
                            @endforeach
                        </aside>
                        <aside class="single_sidebar_widget tag_cloud_widget">
                            <h4 class="widget_title"><i class="fa fa-star">&nbsp;</i> Tags</h4>
                            <ul class="list">
                            	@foreach($blogDetails->tags as $eachTags)
                                <li>
                                    <a href="#">{{ $eachTags->name }}</a>
                                </li>
                                @endforeach
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