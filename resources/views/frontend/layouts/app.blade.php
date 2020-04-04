<!doctype html>
<html lang="en">
@if(auth()->user() && isset($user))
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
  @if ($message = Session::get('success'))
  @component('layouts.components.home_response' ,['type'=>'success'])
               {{ $message }}
  @endcomponent      
@endif  
@if ($message = Session::get('error'))
  @component('layouts.components.home_response',['type'=>'error'])
               {{ $message }}
  @endcomponent       
@endif
@if ($message = Session::get('status'))
  @component('layouts.components.home_response' ,['type'=>'success'])
               {{ $message }}
  @endcomponent 
@endif  
<div class="wrapper" >
<div id="app">
    <section class="header-top">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-4 col-md-4 col-sm-4 col-3 logo-wrapper">
                    <a href="/blog" class="logo">
                        <img src="{{asset('uploads/sitesettings-images/'. config('settings.image') )}}" alt='logo' >
                    </a>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-9  search-trigger">
                    <div class="right-button">
                        @if(!auth()->user())
                        <ul>
                           <!--  <li><a id="search" href="javascript:void(0)"><i class="fas fa-search"></i></a></li> -->
                            <li><login-button></login-button></li>
                            <li><signup-button></signup-button></li>
                            
                        </ul>
                        @else
                         <ul>
                        <li><a id="create Post" href="/blog/add"><i class="fa fa-plus-circle"></i></a></li>
                        <li class="nitify dropdown">
                            <a  href="javascript:void(0)" class="dropdown-toggle top_icon" 
                            data-toggle="dropdown" role="button" aria-haspopup="true" 
                            aria-expanded="false" title="Notifications"><i class="fas fa-bell"></i>@if(auth()->user()->unreadNotifications()->count()>0)  
                            <em >{{ auth()->user()->unreadNotifications()->count() }}</em>
                            @endif
                            </a>
                                <notification-loading :notificationList="[]" :loadtype="'fullload'" :type="'nav'" ></notification-loading>
                                
                        </li>
                   
                        <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <small>Welcome!</small>
                                <figure>
                                  @if(auth()->user()->image)
                                      @if(preg_match('/http(s)?:\/\//',auth()->user()->image))
                                        <img src="{{ auth()->user()->image}}">
                                      @else
                                       <img src="{{ url('/uploads/user-images/'.auth()->user()->image)}}">
                                      @endif

                                  @else
                                    <img src="{{ url('/frontend/images/elements/default-profile.png') }}">
                                  @endif
                                </figure>
                                <b class="u_name"><?php  
                                $name=auth()->user()->name;
                                $allNameArray=explode(' ',$name);
                                ?> {{ $allNameArray['0'] }}
                                </b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="/dashboard"> My Dashboard</a></li>
                                <li><a href="/profile"> Profile</a></li>
                                <li><a href="/categories">Choose your interest</a></li>
                                <li><a href="/saved/blog">Saved</a></li>
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
    

    <header id="header" class="header_area"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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

                            	<a class="nav-link {{ request()->is('/category/'.$eachCategory->slug) ? 'active' : '' }}" href="{{route('blogbycategory',$eachCategory->slug)}}">{{$eachCategory->name }}</a></li> 
                            @endforeach
                            <li class="nav-item"><a class="nav-link" href="/all/category">More</a></li>
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

<script>
$(document).ready(function () {
 
window.setTimeout(function() {
    $("#display-message").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 2000);
 
});
</script>
<script type="text/javascript">
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip()
    });
    
</script>

</body>
</html>