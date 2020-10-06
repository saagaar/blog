@extends('frontend.layouts.app')
@section('content')
@php
      $author=   ($blogDetails->anynomous=='2') ? (isset($blogDetails->user->name)  ?  $blogDetails->user->name :'Admin'):' Anynomous ';
@endphp
	<div class="mid_part">
        @section('meta_url',config('settings.url').'/blog/detail/'. $blogDetails->code.'/'.str_slug($blogDetails->title))
        @section('meta_title',$blogDetails->title.' | By '.$author) 
        @section('meta_description',$blogDetails->short_description)
        @section('meta_image',asset('/uploads/blog/'.$blogDetails->code.'/'.$blogDetails->image))
        @if(isset($seo))
            @section('schema1',$seo->schema1)
            @section('schema2',$seo->schema2)
        @endif
     @php 
     $keywords=$blogDetails->title;
     if(isset($blogDetails->tags) && count($blogDetails->tags)>0):
         foreach($blogDetails->tags as $eachTags):
            $keywords=$eachTags->name.',';
         endforeach;
     endif;
     @endphp   
     @section('meta_keyword',trim($keywords,','))
        <meta type="hidden" name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
        <!--================Blog Area =================-->
    <section class="blog_area single-post-area ">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list pad-right-0">
                    <div class="white-box single-post ">
                    <div class="row ck-content">
                     <div class="col-lg-12">
                        <div class="feature-img">
                            @if($blogDetails->image)
                                  <!-- <img class="img-fluid " src="{{ asset('/uploads/blog/'.$blogDetails->code.'/'.$blogDetails->image) }}"  alt=""> -->

                                   <img class="img-fluid  image-placeholder blur" src="{{ '/image/'.$blogDetails->code.'/10/'.$blogDetails->image }}" data-src="{{ '/image/'.$blogDetails->code.'/500/'.$blogDetails->image }}" alt="" style="min-width: 100%">
                            @else
                                 <img class="img-fluid" src="{{ asset('/frontend/images/elements/default-post.jpg') }}" alt="">

                            @endif
                        </div>
                        <div class="blog_details " >
                            <div class="meta-top d-flex"><a href="#"><i class="far fa-user"></i>  
                                @php
                               echo  ($blogDetails->anynomous=='2') ? (isset($blogDetails->user->name)  ? '<a href="'.url('profile/'.$blogDetails->user->username).'">By '. $blogDetails->user->name.'</a>' : '<a >Admin</a>'):'<a > Anynomous </a>'
                                @endphp  </a></div>
                            <h2>{{ $blogDetails->title }}</h2>


                            <div class="row dtl_share_area">
                                <div class="col-md-8">
                                        <ul class="blog-info-link mt-2 mb-2">
                                                <li>
                                                <span class="align-middle">
                                                @if(!auth()->user())
                                                <likes v-bind:currentblog="{{$blogDetails}}"  :blogCode="'{{$blogDetails->code}}'" :text="' appreciate'"></likes>
                                                @else
                                                <likes v-bind:currentblog="{{$blogDetails}}"  :blogCode="'{{$blogDetails->code}}'" :text="' appreciate'" :likes="{{$likes}}"></likes>
                                                @endif
                                                </span></li>
                                                <li><icon-comments-count></icon-comments-count></li>
                                                <li>{{$totalShare['total_share']}} Share</li>
                                                <li>{{$blogDetails->views}} Views</li>
                                        </ul>
                                </div>
                                <div class="col-md-4 text-right"> 
                                    <ul class="blog-info-link mt-2 mb-2 top-social">
                                            @php
                                            $url=url('blog/detail/'.$blogDetails->code.'/'.str_slug($blogDetails->title).'?share=social');
                                            @endphp
                                            <fb-share :url="'{{$url}}'" :blog="{{$blogDetails}}"></fb-share>
                                            <tw-share :url="'{{$url}}'" :blog="{{$blogDetails}}"></tw-share>    
                                        
                                    </ul>
                                </div>
                            </div>

                           
                            <p class="excert">
                            	{!! $blogDetails->content !!}
                            </p>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="white-box  navigation-top">
                        <div class="d-sm-flex justify-content-between text-center">
                            <p class="like-info"><span class="align-middle">
                                @if(!auth()->user())
                                <likes v-bind:currentblog="{{$blogDetails}}"  :blogCode="'{{$blogDetails->code}}'" :text="'people appreciate this'"></likes>
                                @else
                                <likes v-bind:currentblog="{{$blogDetails}}"  :blogCode="'{{$blogDetails->code}}'" :text="'people appreciate this'" :likes="{{$likes}}"></likes>
                                @endif
                            </span></p>
                            <div class="col-sm-4 text-center my-2 my-sm-0">
                                <p class="comment-count"><span class="align-middle"></span> <icon-comments-count></icon-comments-count></p>
                            </div>
                            <ul class="social-icons">
                                @php
                                $url=url('blog/detail/'.$blogDetails->code.'/'.str_slug($blogDetails->title).'?share=social');
                                @endphp
                    
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
                                        <a href="{{ route('blog.detail' , [$prev->code,str_slug($prev->title)])}}">
                                            <i class="fas fa-arrow-left"></i>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <p>Prev Post</p>
                                        <a href="{{ route('blog.detail' , [$prev->code,str_slug($prev->title)])}}">
                                            <h4>{{ $prev->title }}</h4>
                                        </a>
                                    </div>
                                    
                                    <div class="arrow">
                                        <a href="{{ route('blog.detail' , [$prev->code,str_slug($prev->title)])}}">
                                            <span class="lnr text-white lnr-arrow-left"></span>
                                        </a>
                                    </div>
                                    
                                    @endif
                                </div>
                                
                                
                                <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                    @if($next)
                                    <div class="details">
                                        <p>Next Post</p>
                                        <a href="{{ route('blog.detail' , [$next->code,str_slug($next->title)])}}">
                                            <h4>{{ $next->title }}</h4>
                                        </a>
                                    </div>
                                    <div class="arrow">
                                        <a href="{{ route('blog.detail' , [$next->code,str_slug($next->title)])}}">
                                            <span class="lnr text-white lnr-arrow-right"></span>
                                        </a>
                                    </div>
                                    <div class="thumb">
                                        <a href="{{ route('blog.detail' , [$next->code,str_slug($next->title)])}}">
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <!-- 
                            Google ads section
                     -->


                     <div class="comments-area white-box">
                     <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- Blog Details Horizontal -->
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-9412996680861033"
                             data-ad-slot="3705784798"
                             data-ad-format="auto"
                             data-full-width-responsive="true"></ins>
                        <script>
                             (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                     

                     <!-- 
                          Ends  Google ads section
                     -->
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
                    <comment v-bind:blog="{{ $blogDetails }}" :allComment="{{ json_encode($blogComment) }}"></comment>
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
                                    <a href="{{ route('blog.detail' , [$eachRelatedBlog->code,str_slug($eachRelatedBlog->title)])}}">
                                        <h3>{{ str_limit($eachRelatedBlog->title, $limit = 35, $end = '...') }}</h3>
                                    </a>
                                    <p>{{ $eachRelatedBlog->created_at->diffForHumans() }}</p>
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
                        @if($blogDetails->user_id)
                        <aside class="single_sidebar_widget newsletter_widget">
                            <h4 class="widget_title"><i class="fa fa-star">&nbsp;</i> Newsletter</h4>
                            
                           <user-subscribe :code="'{{$blogDetails->code}}'"></user-subscribe>
                           
                        </aside>
                        @endif
                     <!-- 
                            Google ads section
                     -->

                        <aside class=" googleads single_sidebar_widget newsletter_widget">
                       
                           <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <ins class="adsbygoogle"
                                     style="display:block"
                                     data-ad-client="ca-pub-9412996680861033"
                                     data-ad-slot="5933520558"
                                     data-ad-format="auto"
                                     data-full-width-responsive="true"></ins>
                                <script>
                                     (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>

                        </aside>
                        <aside class=" googleads single_sidebar_widget newsletter_widget">

                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <ins class="adsbygoogle"
                                     style="display:block"
                                     data-ad-client="ca-pub-9412996680861033"
                                     data-ad-slot="5933520558"
                                     data-ad-format="auto"
                                     data-full-width-responsive="true"></ins>
                                <script>
                                     (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                        </aside>
                        <aside class=" googleads single_sidebar_widget newsletter_widget">    
                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <ins class="adsbygoogle"
                                     style="display:block"
                                     data-ad-client="ca-pub-9412996680861033"
                                     data-ad-slot="5933520558"
                                     data-ad-format="auto"
                                     data-full-width-responsive="true"></ins>
                                <script>
                                     (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                        </aside>

                     <!-- 
                            Google ads section
                     -->
                                
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area end =================-->
    <div class="clearfix"></div>
</div>
@endsection