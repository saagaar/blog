<!doctype html>
<html lang="en">
<!--================ Start Meta Elements and includes=================-->
@include('frontend.common.header')
<!--================ End of Meta Elements and includes=================-->

<body>
<div class="wrapper" >
<div >
    <div class="mid_part" id="dashboard">
        <!-- <router-link to="/">Dashboard</router-link> -->
	   </div>
</div>
    <!-- ================ start footer Area ================= -->
</div>


<script src="{{ asset('frontend/js/dashboard.js') }}"></script>
<script src="{{ asset('frontend/js/common.js') }}"></script>


<script type="text/javascript">
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip()
    });
</script>
</body>
</html>