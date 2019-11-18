<!DOCTYPE html>
<html lang="en">
<head>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-80347372-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-80347372-2');
</script>
<script type="text/javascript">
   window.__allCategory__ = '{!! addslashes(json_encode($CategoryByWeight)) !!}'
</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- SEO Meta Tags -->
    <meta name="description" content="Free mobile app HTML landing page template to help you build a great online presence for your app which will convert visitors into users">
    <meta name="author" content="Inovatik">
     <meta name="csrf-token" content="{{ csrf_token()}}">
    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content="" /> <!-- website name -->
    <meta property="og:site" content="" /> <!-- website link -->
    <meta property="og:title" content=""/> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article" />

    <!-- Website Title -->
    <title>Blog Sagar - Social Media</title>    
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i" rel="stylesheet">
    <link href="{{ asset('frontend/css/landing-page.css')}}" rel="stylesheet">

    <!-- Favicon  -->

    <link rel="icon" href="{{asset('landing-page/assets/images/favicon.png')}}">
</head>
<body>
<div id="landing-page">
   <!-- navigation -->
<section class="fixed-top navigation">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="index.html"><img src="landing-page/assets/images/logo.png" alt="logo"></a>
      <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- navbar -->
      <div class="collapse navbar-collapse text-center" id="navbar">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#home"><b>Home</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link page-scroll" href="#feature  "><b>Feature  </b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link page-scroll" href="#team"><b>Testimonials</b></a>
          </li>
         <!--  <li class="nav-item">
            <a class="nav-link" href="login.html"><b>Login</b></a>
          </li> -->
        </ul>
        <a href="/home" class="btn btn-primary ml-lg-3 primary-shadow">Join Now</a>
      </div>
    </nav>
  </div>
</section>
<!-- /navigation -->

<!-- hero area -->


<section class="hero-section" data-background="" id="home" style="background-image: url(landing-page/assets/images/hero-area/banner-bg.png);">
  <div class="container">
    <div class="row">
    @if(count($banner)>0 && is_object($banner))
    @foreach($banner as $eachBanner)    
      <div class="col-lg-12 text-center">        
        <h1 class="mb-3">{{$eachBanner->title}}</h1>
        <p class="mb-4">{{$eachBanner->description}}</p>
        <a href="" class="btn btn-secondary btn-lg mb-5">explore us</a>
        <!-- banner image -->
        <img class="img-fluid" src="landing-page/assets/images/hero-area/banner.png" alt="banner-img">        
      </div>
      @endforeach
      @else
         <div class="col-lg-12 text-center">        
        <h1 class="mb-3">Update Title From Backend</h1>
        <p class="mb-4"> </p>
        <a href="{{$eachBanner->link}}" class="btn btn-secondary btn-lg mb-5">explore us</a>
        <!-- banner image -->
      </div>
      @endif

    </div>
  </div>
</section>
<!-- /hero-area -->

<!-- feature   -->
 @if(count($services)>0 && is_object($services))
<section class="section    mb-0" id="feature">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="section-title">Awesome Features</h2>
        <p class="mb-100">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.<br>Excepteur sint occaecat cupidatat non proident</p>
      </div>
      <!-- feature item -->
      @foreach($services as $eachService)     
      <div class="col-md-6 mb-80">
        <div class="d-flex feature-item">
          <div class="pr-4">
             <img src="{{asset('uploads/services-images/'.$eachService->icon) }}" alt="Blog Image" height="120" width="100">
          </div>
          <div>
            <h4>{{$eachService->title}}</h4>
            <p>{{$eachService->description}}</p>
          </div>
        </div>
      </div>
      @endforeach      
      <!-- feature item -->
    </div>
  </div>
  <img class="feature-bg-1" src="landing-page/assets/images/background-shape/feature-bg-1.png" alt="bg-shape">
  <img class="feature-bg-2" src="landing-page/assets/images/background-shape/feature-bg-2.png" alt="bg-shape">
</section>
@endif
<!-- /feature -->

<!-- marketing -->
<section class="section-lg seo">
  <div class="container">
    <div class="row"> 
        <div class="col-md-6 order-2 order-md-1">
        <h2 class="section-title">Powerful & Elegant Layout From Top To Bottom Of The Design</h2>
        <p class="mb-4">Far far away, behind the word mountains,
          far from the countries Vokalia and Consonantia,
          there live the blind texts. Separated they
          live in Bookmarksgrove right at the coast of the
          Semantics, a large language ocean.</p>
        <ul class="pl-0 service-list">
          <li><i class="ti-layout-tab-window"></i>Responsive on any device</li>
          <li><i class="ti-layout-placeholder"></i>Very easy to customize</li>
          <li><i class="ti-support"></i>Effective support</li>
        </ul>
      </div>
      <div class="col-md-5">
        <h2 class="section-title"></h2>
       <!--  <p>Far far away, behind the word mountains, far
          from the countries Vokalia and Consonantia.<br>
          There live the blind texts. Separated they
          live in Bookmarksgrove right at the coast of
          the Semantics, a large language ocean.
        </p> -->
      </div>
    </div>
  </div>
  <!-- background image -->
  <img class="img-fluid seo-bg" src="landing-page/assets/images/backgrounds/seo-bg.png" alt="seo-bg">
  <!-- background-shape -->
  <img class="seo-bg-shape-1" src="landing-page/assets/images/background-shape/seo-ball-1.png" alt="bg-shape">
  <img class="seo-bg-shape-2" src="landing-page/assets/images/background-shape/seo-half-cycle.png" alt="bg-shape">
  <img class="seo-bg-shape-3" src="landing-page/assets/images/background-shape/seo-ball-2.png" alt="bg-shape">
</section>
<!-- /marketing -->

<!-- service -->
<section class="section-lg service">
  <div class="container">
    <div class="row">

   <div
              :style="(progressVisible && progress)
                ? {
                  filter: 'blur(8px)',
                  opacity: 0.3,
                  pointerEvents: 'none',
                  transform: 'scale(0.7,0.7)',
                }
                : {}
              "
              style="
                bottom: 0;
                left: 0;
                position: absolute;
                right: 0;
                top: 0;
                transition-duration: 0s;
              "
            >
              <vue-word-cloud
                :animation-duration="5"
                :animation-easing="animationEasing"
                :animation-overlap="animationOverlap"
                :color="color"
                :enter-animation="'rotate'"
                :font-family="fontFamily"
                :font-size-ratio="fontSizeRatio"
                :leave-animation="leaveAnimation"
                :load-font="loadFont"
                :progress.sync="progress"
                :rotation="rotation"
                :spacing="spacing"
                :words="words"
              >
                
              </vue-word-cloud>
              </div>
            <!-- <v-scale-transition> -->
              <v-progress-bar
                v-if="progressVisible && progress "
                :percentcompleted="Math.round(progress.completedWords / progress.totalWords) * 100"
                :totalwords="progress.totalWords"
                style="
                  bottom: 0;
                  left: 0;
                  margin: auto;
                  position: absolute;
                  right: 0;
                  top: 0;
                "
              >
             </v-progress-bar>

            

            
     <!--  <div class="col-md-6 order-2 order-md-1">
        <h2 class="section-title">Powerful & Elegant Layout From Top To Bottom Of The Design</h2>
        <p class="mb-4">Far far away, behind the word mountains,
          far from the countries Vokalia and Consonantia,
          there live the blind texts. Separated they
          live in Bookmarksgrove right at the coast of the
          Semantics, a large language ocean.</p>
        <ul class="pl-0 service-list">
          <li><i class="ti-layout-tab-window"></i>Responsive on any device</li>
          <li><i class="ti-layout-placeholder"></i>Very easy to customize</li>
          <li><i class="ti-support"></i>Effective support</li>
        </ul>
      </div>
      <div class="col-md-6 order-1 order-md-2">
        <img class="img-fluid" src="slanding-page/assets/images/service/service.png" alt="service">
      </div> -->
    </div>
  </div>
  <!-- background image -->
  <img class="img-fluid service-bg" src="landing-page/assets/images/backgrounds/service-bg.png" alt="service-bg">
  <!-- background shapes -->
  <img class="service-bg-shape-1" src="landing-page/assets/images/background-shape/service-half-cycle.png" alt="background-shape">
  <img class="service-bg-shape-2" src="landing-page/assets/images/background-shape/feature-bg-2.png" alt="background-shape">
</section>
<!-- /service -->

<!-- team -->
<section class="section-lg team" id="team">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="section-title">What our</h2>
        <p class="mb-100">INFLUENCER SAYS ?</p>
      </div>
    </div>
    <div class="col-12">
      <div class="team-slider">
        <!-- team-member -->
        @foreach ($testimonialDetails as $eachDetails)
        <div class="team-member">        
          <div class="d-flex mb-4">
            <div class="mr-3">
              <img class="rounded-circle" src="{{asset('uploads/testimonial-images/'.$eachDetails->image) }}"  width="100" height="100" alt="Testimonial image">
            </div>
            <div class="align-self-center">                            
              <h4>{{$eachDetails->name}}</h4>
              <h6 class="text-color">{{$eachDetails->position}}</h6>              
            </div>
          </div>
          <p>{{$eachDetails->description}}</p>        
        </div>
        @endforeach

        <!-- team-member -->
        
      </div>
    </div>
  </div>
  <!-- backgound image -->
  <img src="landing-page/assets/images/backgrounds/team-bg.png" alt="team-bg" class="img-fluid team-bg">
  <!-- background shapes -->
  <img class="team-bg-shape-1" src="landing-page/assets/images/background-shape/seo-ball-1.png" alt="background-shape">
  <img class="team-bg-shape-2" src="landing-page/assets/images/background-shape/seo-ball-1.png" alt="background-shape">
  <img class="team-bg-shape-3" src="landing-page/assets/images/background-shape/team-bg-triangle.png" alt="background-shape">
  <img class="team-bg-shape-4 img-fluid" src="landing-page/assets/images/background-shape/team-bg-dots.png" alt="background-shape">
</section>
<!-- /team -->

<!-- client logo slider -->
<section class="section">
  <div class="container">
    
      <div class="client-logo-slider align-self-center">
        @foreach($client as $eachClient)
          <a href="{{$eachClient->url}}" class="text-center d-block outline-0 p-5"><img class="d-unset img-fluid" src="{{asset('uploads/client-images/'.$eachClient->logo) }}" style="height:60px; width:120px;" alt="client-logo"></a>
           @endforeach         
      </div>
     
  </div>
</section>
<!-- /client logo slider -->

<!-- newsletter -->
<section class="newsletter">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2>Subscribe to our newsletter</h2>
        <p class="mb-5">Receive updates, news and deals</p>
      </div>
      <div class="col-lg-8 col-sm-10 col-12 mx-auto">
        <form action="#">
          <div class="input-wrapper position-relative">
            <input type="email" class="newsletter-form" id="newsletter" placeholder="Enter your email">
            <button type="submit" value="send" class="btn newsletter-btn">subscribe</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- background shapes -->
  <img class="newsletter-bg-shape" src="landing-page/assets/images/background-shape/seo-ball-2.png" alt="background-shape">
</section>
<!-- /newsletter -->

<!-- footer -->

<footer class="section-lg footer pb-100" style="background-image:url(landing-page/assets/images/backgrounds/footer-bg.png);">
  <div class="container">
    <div class="row">
       <div class="col-lg-3 text-center text-lg-left mb-4 mb-lg-0">
        <a href="index.html">
          <img class="img-fluid" src="landing-page/assets/images/logo.png" alt="logo">
          </a>
                </div>


      <!-- footer menu -->
      <nav class="col-lg-5 align-self-center mb-5">
        <h4>Get In Touch</h4>
        <a href="{{$getInTouch->url}}">{{$getInTouch->site_name}}</a><br>
        <p>{{$getInTouch->address}}<br>{{$getInTouch->contact_number}}<br><a href="#">hi@blogsagar.com </a></p>
      </nav>  
      <!-- footer social icon -->
      <nav class="col-lg-4">
        <ul class="list-inline text-lg-right text-center social-icon">
          <li class="list-inline-item">
            <a class="facebook" href="{{$getInTouch->facebook_id}}"><i class="ti-facebook"></i></a>
          </li>
          <li class="list-inline-item">
            <a class="twitter" href="{{$getInTouch->twitter_id}}"><i class="ti-twitter-alt"></i></a>
          </li>
          <li class="list-inline-item">
            <a class="linkedin" href="{{$getInTouch->linkedin_id}}"><i class="ti-linkedin"></i></a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</footer>
</div>
<!-- /footer -->



    <script src="https://cdnjs.cloudflare.com/ajax/libs/chance/1.0.16/chance.min.js"></script>


    <!-- Scripts -->
    <script src="{{ asset('frontend/js/landing-page.js')}}"></script> 

</body>
</html>