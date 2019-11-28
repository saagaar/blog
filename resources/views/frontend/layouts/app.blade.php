<!doctype html>
<html lang="en">
@if(auth()->user())
<script type="text/javascript">
	 window.__USER_STATE__ = '{!! addslashes(json_encode($user)) !!}'
	 window.__NOTIFICATION__ = '{!! addslashes(json_encode($user["notifications"])) !!}'
	 
</script>
@endif
<!--================ Start Meta Elements an
<!--================ Start Meta Elements and includes=================-->
@include('frontend.common.header')
<!--================ End of Meta Elements and includes=================-->
<body>

<div class="wrapper" >
<div id="app">
	<section class="header-top">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-4 col-md-4 col-sm-4 logo-wrapper">
                    <a href="/blog" class="logo">

                        <img src="{{asset('uploads/sitesettings-images/'.$websiteLogo)}}"alt='logo' >
                    </a>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 search-trigger">
                    <div class="right-button">
                        @if(!auth()->user())
                        <ul>
                            <li><a id="search" href="javascript:void(0)"><i class="fas fa-search"></i></a></li>
                            <li><login-button></login-button></li>
                            <li><signup-button></signup-button></li>
                            
                        </ul>
                        @else
                         <ul>
                        <li><a id="search" href="javascript:void(0)"><i class="fas fa-search"></i></a></li>
                      
                        <li class="nitify dropdown">
                            <a  href="javascript:void(0)" class="dropdown-toggle top_icon" 
                            data-toggle="dropdown" role="button" aria-haspopup="true" 
                            aria-expanded="false" title="Notifications"><i class="fas fa-bell"></i>@if(auth()->user()->unreadNotifications()->count()>0)  
                            <em >{{ auth()->user()->unreadNotifications()->count() }}</em>
                            @endif
                            </a>
                               <notification-loading :notificationlist="[]" :loadtype="'fullload'" :type="'nav'" ></notification-loading>
                                
                        </li>

                        <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <small>Welcome !</small>
                                <figure>
                                  @if(auth()->user()->image)
                                    <img src="{{ url('/uploads/user-images/'.auth()->user()->image)}}">
                                  @else
                                    <img src="{{ url('/frontend/images/elements/default-profile.png') }}">
                                  @endif
                                </figure><?php  
                                $name=auth()->user()->name;
                                $allNameArray=explode(' ',$name);
                                ?> {{ $allNameArray['0'] }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="/dashboard"> My Dashboard</a></li>
                                <li><a href="/profile"> Profile</a></li>
                                <li><a href="/categories">Choose your interest</a></li>
                                  <hr/>
                                <li><a href="/blog/add">New Article</a></li>
                                <li><a href="/blog/list">My Articles</a></li>
                                  <hr/>
                                <li><a href="/settings">Settings</a></li>
                                <!-- <li><a href="#">Help</a></li> -->
                                <!-- <li><a href="#">Change Password</a></li> -->
                                <li><a href="/logout/user">Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                    @endif
                    </div>
                </div>
            </div>
        </div>
<success-error-message></success-error-message>
        
    <!--     <div class="search_input" id="search_input_box" ref="search_input_box" >
            <div class="container ">
                <form class="d-flex justify-content-between search-inner">
                    <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="ti-close" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div> -->

    </section>
    
      <the-login-signup-modal></the-login-signup-modal>
    

	<header id="header" class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav mr-auto">
                        	<li class="nav-item"><a class="nav-link" href="{{route('home')}}">Home</a></li>  
                        	@foreach($navCategory as $eachCategory)
                            <li class="nav-item">
                            	<a class="nav-link {{ request()->is('/blogbycategory/'.$eachCategory->slug) ? 'active' : '' }}" href="{{route('blogbycategory',$eachCategory->slug)}}">{{$eachCategory->name }}</a></li> 
                            @endforeach
                            <!-- <li class="nav-item"><a class="nav-link" href="category.html">Categories</a></li> 
                            <li class="nav-item"><a class="nav-link" href="archive.html">Archive</a></li>     -->
                            <!-- <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
                                    <li class="nav-item"><a class="nav-link" href="single-blog.html">Blog Details</a></li>
                                </ul>
                            </li> -->
                            <!-- <li class="nav-item"><a class="nav-link" href="blog.html">Latest news</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact.html">Contact us</a></li>   
                             <li class="nav-item"><a class="nav-link" href="#">Human</a></li>  
                             <li class="nav-item"><a class="nav-link" href="#">Startups</a></li>   
                             <li class="nav-item"><a class="nav-link" href="#">Technology</a></li>  
                             <li class="nav-item"><a class="nav-link" href="#">Heated</a></li>
                             <li class="nav-item"><a class="nav-link" href="#">More</a></li>  -->       
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
	<the-footer></the-footer>
	 @yield('content')
	 
	
</div>
  
</div>


<script src="{{ asset('frontend/js/app.js') }}"></script>
<script src="{{ asset('frontend/js/common.js') }}"></script>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11&appId=671302589946860';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function fb_share(dynamic_link,dynamic_title) {
    var app_id = '671302589946860';
    var pageURL="https://www.facebook.com/dialog/feed?app_id=" + app_id + "&link=" + dynamic_link;
    var w = 600;
    var h = 400;
    var left = (screen.width / 2) - (w / 2);
    var top = (screen.height / 2) - (h / 2);
    window.open(pageURL, dynamic_title, 'toolbar=no, location=no, directories=no, status=no, menubar=yes, scrollbars=no, resizable=no, copyhistory=no, width=' + 800 + ', height=' + 650 + ', top=' + top + ', left=' + left)
    return false;
}
</script>

<script>
    $(function(){
  $('.fb-share').click(function(){
    var url=$(this).data('url');
      FB.ui({
      method: 'share',
      href: url,
    }, function(response){
        if(response!==undefined)
        {
             jQuery.ajax({
                        type: "POST",
                        url: sharecount,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data:{url:url,media:'facebook'},
                        datatype: 'json',
                        success: function(data) 
                        {
                            $('.img-loader').addClass('hidden');
                             // data = jQuery.parseJSON(datajson);
                            
                        }
                    });       
        }
    });
  })
})
</script>
<script type="text/javascript">
    function loguser( event ) {
    if ( event ) {
        jQuery.ajax({
                    type: "POST",
                    url: sharecount,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:{url:event.target.baseURI,media:'twitter'},
                    datatype: 'json',
                    success: function(data) 
                    {
                        // $('.img-loader').addClass('hidden');
                        //  data = jQuery.parseJSON(datajson);
                        // console.log(data);
                        // if(data.status=='success')
                        // {
                        //     preloadedimage--;
                        // }
                        // else{
                        //     tempimage--;
                        // }
                    }
                });  
        // alert( 'Tweeted' );
        console.log( event );
    }
}

window.twttr = (function (d,s,id) {
    var t, js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
    js.src="//platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
    return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
    }(document, "script", "twitter-wjs"));
 
twttr.ready(function (twttr) {
    twttr.events.bind('tweet', loguser);
});
</script>
<script type="text/javascript">
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip()
    });
</script>
<script type="text/javascript">
    var sharecount = "{{route('share')}}";
</script>
</body>
</html>