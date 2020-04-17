<!doctype html>
<html lang="en">
<script type="text/javascript">
     window.__INITIAL_STATE__ = '{!! addslashes(json_encode($initialState)) !!}'
	 window.__USER_STATE__ = '{!! addslashes(json_encode($user)) !!}'
</script>
@if(auth()->user() && isset($user))
<script type="text/javascript">
     window.__NOTIFICATION__ = '{!! addslashes(json_encode($user["notifications"])) !!}'
</script>

@endif

    @if($user)    
        @section('meta_url',url()->current())
        @section('meta_description',$user['bio'])
        @section('meta_title','Profile: '.$user['name'].'- TheBloggersClub.com')
        @section('meta_image',asset('uploads/user-images/'.$user['image']))
    @endif

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