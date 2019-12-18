
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-80347372-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-80347372-2');
</script>

  <meta name="google-site-verification" content="Z0avWmdSYKivNtZkEucKSG1uK9pKgJ14fNdgUP7qncA" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token()}}">


      <link rel="shortcut icon" href="/favicon.ico">
      <link rel="icon" sizes="16x16 32x32 64x64" href="/favicon.ico">
      <link rel="icon" type="image/png" sizes="192x192" href="{{url('frontend/images/fav-ico/android-icon-192x192.png')}}">
       <link rel="icon" type="image/png" sizes="196x196" href="{{url('frontend/images/fav-ico/android-icon-36x36.png')}}">
      <link rel="icon" type="image/png" sizes="160x160" href="{{url('frontend/images/fav-ico/favicon-16x16.png')}}">
      <link rel="icon" type="image/png" sizes="96x96" href="{{url('frontend/images/fav-ico/android-icon-96x96.png')}}">
      <link rel="icon" type="image/png" sizes="32x32" href="{{url('frontend/images/fav-ico/favicon-32x32.png')}}">
      <link rel="icon" type="image/png" sizes="16x16" href="{{url('frontend/images/fav-ico/favicon-16x16.png')}}">
      <link rel="icon" href="{{url('frontend/images/fav-ico')}}/favicon.ico">
      <link rel="apple-touch-icon" sizes="114x114" href="{{url('frontend/images/fav-ico/apple-icon-114x114.png')}}">
      <link rel="apple-touch-icon" sizes="72x72" href="{{url('frontend/images/fav-ico/apple-icon-72x72.png')}}">
      <link rel="apple-touch-icon" sizes="144x144" href="{{url('frontend/images/fav-ico')}}/apple-icon-144x144.png">
      <link rel="apple-touch-icon" sizes="60x60" href="{{url('frontend/images/fav-ico')}}/apple-icon-60x60.png">
      <link rel="apple-touch-icon" sizes="120x120" href="{{url('frontend/images/fav-ico')}}/apple-icon-120x120.png">
      <link rel="apple-touch-icon" sizes="76x76" href="{{url('frontend/images/fav-ico')}}/apple-icon-76x76.png">
      <link rel="apple-touch-icon" sizes="152x152" href="{{url('frontend/images/fav-ico')}}/apple-icon-152x152.png">
      <link rel="apple-touch-icon" sizes="180x180" href="{{url('frontend/images/fav-ico')}}/apple-icon-180x180.png">
  
    <link rel="stylesheet" href="{{ asset('frontend/css/app.css') }}">    
    <link rel="stylesheet" href="{{ asset('landing-page/assets/css/fontawesome-all.css') }}">    
    <title>The Bloggers Club-an online blogging platform for independent voices.</title>
    <meta name="keywords" content="@yield('meta_keyword','Blogs,bloggers blog,Bloggers Club,Online Blogging Platform,Categories for blog posts,Categories for blog,Blog with categories')">
    <meta name="title" content="@yield('meta_title','The Bloggers Club-an online blogging platform for independent voices.')">
    <meta name="url" content="{{config('settings.site_name')}}">
    <meta name="description" content="@yield('meta_description','Bloggers Club is an online blogging platform for posting your unique,creative articles in different categories and for those who loves to learn innovative things and express their words in order to link with the world.')">   
    <meta name="author" content="@{{ config('settings.site_name')}}">
    <meta name="robots" content="index,follow">
    <link rel="cannonical" href="{{config('settings.site_name')}}">


  <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->

  <meta property="og:locale" content="en_US" />
  <meta property="og:site_name" content="{{ config('settings.site_name')}}" /> <!-- website name -->
  <meta property="og:site" content="{{config('settings.url')}}" /> <!-- website link -->
  <meta property="og:title" content="@yield('meta_title','The Bloggers Club-an online blogging platform for independent voices.')"/>
  <meta property="og:description" content="@yield('meta_description','Bloggers Club is an online blogging platform for posting your unique,creative articles in different categories and for those who loves to learn innovative things and express their words in order to link with the world.')" /> 
  <meta property="og:image" content="@yield('meta_image')" /> 
  <meta property="og:url" content="@yield('meta_url')" /> 
  <meta property="og:type" content="article" />
  <meta property="fb:page_id" content="102453021098785" />
  <meta property="fb:app_id" content="456785908272461" />
  
  <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="{{config('settings.site_name')}}" />
        <meta name="twitter:creator" content="{{ config('settings.site_name')}}" />
         <meta name="twitter:title" content="@yield('meta_title','The Bloggers Club-an online blogging platform for independent voices.')"/>
  <meta name="twitter:description" content="@yield('meta_description','Bloggers Club is an online blogging platform for posting your unique,creative articles in different categories and for those who loves to learn innovative things and express their words in order to link with the world.')" /> 
  <meta name="twitter:image:src" content="@yield('meta_image')" /> 
        

   <script type="application/ld+json">
          {
            "@context" : "https://schema.org",
              "@type" : "Blog",
              "Name" : "Bloggers Club",
              "URL" : "https://thebloggersclub.com",
              "contactPoint" : 
              [{
                "@type" : "ContactPoint",
                "telephone" : "+977-9810099062",
                "contactType" : "Call Service"
              }],
              "logo" : "https://thebloggersclub.com/images/logo-6.png",
              "sameAs" : 
              [
                "https://www.facebook.com/The-Bloggers-Club-102453021098785/"
                
               ]
          }
      </script>
  
     <script type="application/ld+json">

            {
                "@context":"https://schema.org",
                "@graph":
                [{
                    "@type": "WebSite", 
                    "url": "https://thebloggersclub.com", 
                    "name": "Bloggers Club", 
                    "alternateName": "Bloggers Club is a home for posting your creativity and learning new ideas from it",
                    "description":"Bloggers Club is an online blogging platform for posting your unique,creative articles in different categories."
                  },

                 {
                     "@type":"ImageObject",
                     "@id":"https://www.thebloggersclub.com/#primaryimage",
                     "url":"https://.jpg",
                     "width":,"height":,
                     "caption":"Bloggers Club"
                 },

                 {
                      "@type":"WebPage",
                      "@id":"https://www.thebloggersclub.com/#webpage",
                      "url":"https://www.thebloggersclub.com/",
                      "inLanguage":"en-US",
                      "name":"Bloggers Club",
                      "isPartOf":
                      {
                        "@id":"https://www.thebloggersclub.com/#website",
                        "description":"Bloggers Club is an online blogging platform for posting your unique,creative articles in different categories."
                      },
                 
                  }
                  ]
              }
    </script>
 

    <!-- Bootstrap CSS -->   
    <style>img[alt="www.000webhost.com"]{display:none}</style>
      <style>
          img[src*="https://cdn.rawgit.com/000webhost/logo/e9bd13f7/footer-powered-by-000webhost-white2.png"]
          {display:none}
      </style>

</head>
