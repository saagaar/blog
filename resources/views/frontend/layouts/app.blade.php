<!doctype html>
<html lang="en">
<!--================ Start Meta Elements and includes=================-->
@include('frontend.common.header')
<!--================ End of Meta Elements and includes=================-->

<body>

<div class="wrapper" id="app">
<!--================ Start header Top Area =================-->
   <top-nav></top-nav>
<!--================ End header top Area =================-->

<!-- Start header Menu Area -->
  @include('frontend.common.main-nav')

<!-- End header MEnu Area -->

    <!--================Fullwidth block Area =================-->

    @yield('content')


    <!--================ three-block section end =================-->  


    <!-- ================ start footer Area ================= -->
        @include('frontend.common.footer')

    <!-- ================ End footer Area ================= -->

    <!-- ================ start footer Area ================= -->
        @include('frontend.common.signin')

    <!-- ================ End footer Area ================= -->
    <!-- ================ start footer Area ================= -->
        @include('frontend.common.signup')

    <!-- ================ End footer Area ================= -->
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