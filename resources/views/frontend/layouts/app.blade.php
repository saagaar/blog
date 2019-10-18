<!doctype html>
<html lang="en">
<!--================ Start Meta Elements and includes=================-->
@include('frontend.common.header')
<!--================ End of Meta Elements and includes=================-->

<body>
<div class="wrapper" >
<div id="app">

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