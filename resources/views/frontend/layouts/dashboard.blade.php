<!doctype html>
<html lang="en">
<script type="text/javascript">
	 window.__USER_STATE__ = '{!! addslashes(json_encode($user)) !!}'
	 window.__INITIAL_STATE__ = '{!! addslashes(json_encode($initialState)) !!}'
</script>
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