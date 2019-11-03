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


<script type="text/javascript">
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip()
    });
</script>
</body>
</html>