<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin | Dashboard</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet"  href="{{ asset('admin/dist/css/select2.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/bower_components/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/dist/css/simplelightbox.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/dist/css/demo.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/dist/css/bootstrap2-toggle.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/bower_components/datetime/css/bootstrap-datetimepicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/dist/plugins/iCheck/all.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/skin-blue.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/dist/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/dist/plugins/wysihtml5/bootstrap3-wysihtml5.min.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="{{ asset('admin/dist/css/style.css') }}">


</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<!--- for error or success message-->
 @if ($message = Session::get('success'))
  @component('layouts.components.response' ,['type'=>'success'])
               {{ $message }}
  @endcomponent      
@endif  
@if ($message = Session::get('error'))
  @component('layouts.components.response',['type'=>'error'])
               {{ $message }}
  @endcomponent       
@endif

 @include('layouts.common.admin_header')
 @include('layouts.common.admin_sidebar')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       {{$breadcrumb['breadcrumbs']['current_menu']}}
        
      </h1>
      <!-- Breadcrumb -->
    @include('layouts.components.breadcrumbs',$breadcrumb)
    </section>
 <!-- Main content partial view loading-->
 @yield('content')
 </div>
 @include('layouts.common.admin_footer')

<div class="control-sidebar-bg"></div>
</div>
<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('admin/dist/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('admin/dist/plugins/wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ asset('admin/dist/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/simple-lightbox.min.js') }}"></script>
<script src="{{ asset('admin/dist/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{ asset('admin/dist/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- <script src="{{ asset('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script> -->

<script src="{{ asset('admin/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/pages/siteoptions.js') }}"></script>
<script src="{{ asset('admin/dist/js/app.js') }}"></script>
<script src="{{ asset('admin/dist/js/bootstrap2-toggle.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/datetime/js/bootstrap-datetimepicker.min.js') }}"></script>

<!-- <script>
  $(function () {
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      timePicker:true
    })
    
  })
</script> -->
<script>
function showFunction() {
  var checkBox = document.getElementById("myCheck");
  var text = document.getElementById("emaildb");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
<script>
function showSmsFunction() {
  var checkBox = document.getElementById("myChecksms");
  var text = document.getElementById("emailsms");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>

<script type="text/javascript">
 function ConfirmDelete() {
    var reconfirm = confirm("Are you sure you want to Delete?");
    if (reconfirm) {
        return true;
    } else {
        return false;
    }
}   
</script>

<script type="text/javascript">
  $('#datetimepicker').datetimepicker({
    format: 'yyyy-mm-dd hh:ii'
});
  $('#datepicker').datetimepicker({
    format: 'yyyy-mm-dd'
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('.js-example-basic-multiple').select2({
      tags: true,
     
    
  });
});
$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 5000);
 
});

</script>
<script>
  $(function(){
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 2;
        var showInHome = $(this).prop('checked') == true ? 1 : 2;
        var paymentmode = $(this).prop('checked') == true ? 1 : 0;
        var savemethod = $(this).prop('checked') == true ? 2 : 1;
        var id = $(this).data('id');
        var url = $(this).data('url');  
        $.ajax({
            type: "GET",
            dataType: "json",
            url: url,
            data: {'status': status,'mode': paymentmode,'save_method':savemethod,'display':status,'show_in_home':showInHome,'id': id},
             success: function(data){
              console.log(data.success)
            }           
        });
    })
  })
</script>
<script>
  $(function(){
  // World map by jvectormap
  $('#world-map').vectorMap({
    map              : 'world_mill_en',
    backgroundColor  : 'transparent',
    regionStyle      : {
      initial: {
        fill            : '#e4e4e4',
        'fill-opacity'  : 1,
        stroke          : 'none',
        'stroke-width'  : 0,
        'stroke-opacity': 1
      }
    },
    series           : {
      regions: [
        {
          values           : visitorsData,
          scale            : ['#92c1dc', '#ebf4f9'],
          normalizeFunction: 'polynomial'
        }
      ]
    },
    onRegionLabelShow: function (e, el, code) {
      if (typeof visitorsData[code] != 'undefined')
        el.html(el.html() + ': ' + visitorsData[code] + ' new visitors');
    }
  });


    var $gallery = $('.gallery a').simpleLightbox();

    $gallery.on('show.simplelightbox', function(){
      console.log('Requested for showing');
    })
    .on('shown.simplelightbox', function(){
      console.log('Shown');
    })
    .on('close.simplelightbox', function(){
      console.log('Requested for closing');
    })
    .on('closed.simplelightbox', function(){
      console.log('Closed');
    })
    .on('change.simplelightbox', function(){
      console.log('Requested for change');
    })
    .on('next.simplelightbox', function(){
      console.log('Requested for next');
    })
    .on('prev.simplelightbox', function(){
      console.log('Requested for prev');
    })
    .on('nextImageLoaded.simplelightbox', function(){
      console.log('Next image loaded');
    })
    .on('prevImageLoaded.simplelightbox', function(){
      console.log('Prev image loaded');
    })
    .on('changed.simplelightbox', function(){
      console.log('Image changed');
    })
    .on('nextDone.simplelightbox', function(){
      console.log('Image changed to next');
    })
    .on('prevDone.simplelightbox', function(){
      console.log('Image changed to prev');
    })
    .on('error.simplelightbox', function(e){
      console.log('No image found, go to the next/prev');
      console.log(e);
    });
  });
</script>

</body>
</html>