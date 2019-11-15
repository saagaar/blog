<!doctype html>
<html lang="en">
<script type="text/javascript">
	 window.__USER_STATE__ = '{!! addslashes(json_encode($user)) !!}'
	 window.__INITIAL_STATE__ = '{!! addslashes(json_encode($initialState)) !!}'
	 
</script>
<!--================ Start Meta Elements an
<!--================ Start Meta Elements and includes=================-->
@include('frontend.common.header')
<!--================ End of Meta Elements and includes=================-->

<body>
<div class="wrapper" >
<div id="app">
	<the-top-nav></the-top-nav>
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



</script>

<script type="text/javascript">
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip()
    });
</script>
</body>
</html>