<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin | Dashboard</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/bower_components/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css') }}">
   <link rel="stylesheet" href="{{ asset('admin/dist/plugins/iCheck/all.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/skin-blue.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/dist/plugins/wysihtml5/bootstrap3-wysihtml5.min.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="stylesheet" href="{{ asset('admin/dist/css/style.css') }}">
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
    @include('includes.breadcrumbs',$breadcrumb)
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

<script src="{{ asset('admin/dist/js/pages/siteoptions.js') }}"></script>
<script src="{{ asset('admin/dist/js/app.js') }}"></script>
</body>
</html>