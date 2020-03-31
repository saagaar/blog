@extends('layouts.common.main')
@section('content')
<!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
    <section class="content-header">
      <h1>
        <small>You are Logged In as Admin!!</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Here</li>
      </ol>    
    </section>

 <section class="content-header">
    <div class="row">
      <div class="col-xs-10">
        
          <div class="box-header">
              <h3 class="box-title">RECENT ACTIVITY</h3>                        
          </div>
          <div class="box-body">
              <div id="world-map" style="height: 250px; width: 100%;"></div>
            </div>
          <div class="box-body">
               
                <h3><strong>Visitors</strong></h3>
                <hr style="border-color:#E3E3E3;">                          
                
            <!-- row -->    
            <div class="row">
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #b67782;color:white;"><span style="font-size:35px;font-weight:bold;">{{  $dashboard['allVisitors']}}</span><br>
                          <a class="dash" href="{{route('websitelog.list')}}"> TOTAL VISITORS</a>
                      </div>
                    </div>
                </div>
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #3C8DBC;color:white;"><span style="font-size:35px;font-weight:bold;">{{$dashboard['allLoggedInVisitors']}}</span>
                          <br><a class="dash" href="{{route('websitelog.list')}}">VISITORS LOGGED IN TODAY</a>
                      </div>
                    </div>
                </div>
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #F26161;color:white;"><span style="font-size:35px;font-weight:bold;">{{$dashboard['allRegisteredVisitors']}}</span> 
                          <br><a class="dash" href="{{route('websitelog.list')}}">PAGES VISITED TODAY</a>
                      </div>
                    </div>
                </div>

            </div>
            <!-- row -->

              <h3><strong>Users</strong></h3>
              <hr style="border-color:#E3E3E3;"> 
           <div class="row">
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color:#00A65A;color:white;"><span style="font-size:35px;font-weight:bold;">{{  $dashboard['allUsers']}}</span> 
                          <br><a class="dash" href="{{route('account.list')}}">TOTAL USERS</a>
                      </div>
                    </div>
                </div>
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #374850;color:white;"><span style="font-size:35px;font-weight:bold;">{{$dashboard['loggedinUsers']}}</span> 
                          <br><a class="dash" href="{{route('account.list')}}">USERS LOGGED IN TODAY</a></div>
                    </div>
                </div>
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #b67782;color:white;"><span style="font-size:35px;font-weight:bold;">{{$dashboard['allRegisteredUsers']}}</span> 
                          <br><a class="dash" href="{{route('account.list')}}">REGISTERED TODAY</a>
                       </div>
                    </div>
                </div>

            </div>
            <!-- row     -->
            <h3><strong>Online Status</strong></h3>
             <hr style="border-color:#E3E3E3;"> 
            <div class="row">
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #00A65A;color:white;"><span style="font-size:35px;font-weight:bold;">{{ $dashboard['activeUsers']}}</span> 
                          <br><a class="dash" href="{{route('account.list')}}"> ACTIVE USERS</a>
                       </div>
                    </div>
                </div>

                 <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #F26161;color:white;"><span style="font-size:35px;font-weight:bold;">{{ $dashboard['inActiveUsers']}}</span> 
                          <br> <a class="dash" href="{{route('account.list')}}">IN ACTIVE USERS</a>
                       </div>
                    </div>
                </div>
                 

            </div>
            <!-- row -->

            <h3><strong>Blogs</strong></h3>
            <hr style="border-color:#E3E3E3;"> 
           <div class="row">
                <div class="col-xs-4">  
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #374850;color:white;"><span style="font-size:35px;font-weight:bold;">{{$dashboard['allBlogUsers']}}</span>
                        <br><a class="dash" href="{{route('blog.list')}}">TOTAL BLOGS</a>
                      </div>
                    </div>
                </div>
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #b67782;color:white;"><span style="font-size:35px;font-weight:bold;">{{$dashboard['publishedBlogs']}}</span>
                          <br><a class="dash" href="{{route('blog.list')}}">PUBLISHED BLOGS</a>
                      </div>
                    </div>
                </div>
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color:#00A65A;color:white;"><span style="font-size:35px;font-weight:bold;">{{ $dashboard['savedBlogs']}}</span>
                          <br><a class="dash" href="{{route('blog.list')}}">SAVED BLOGS</a>
                      </div>
                    </div>
                </div>

            </div>
            <!-- row -->

             <div class="row">
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #3C8DBC;color:white;"><span style="font-size:35px;font-weight:bold;">{{$dashboard['todayPublishedBlogs']}}</span>
                        <br><a class="dash" href="{{route('blog.list')}}">PUBLISHED TODAY</a>
                      </div>
                    </div>
                </div>
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #b67782;color:white;"><span style="font-size:35px;font-weight:bold;">{{$dashboard['publishedBlogsThisMonth']}}</span><br>                       
                            <a class="dash" href="{{route('blog.list')}}">PUBLISHED THIS MONTH</a>
                      </div>
                    </div>
                </div>
            </div>
            <!-- row -->
          </div>    
          <!-- box-body -->
    </div>
  </div>

</section>

 
           

    

@if ($message = Session::get('success'))
<div class="success alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
</div>
@endif  
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
</div>
@endif
    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->

    </section>
    <!-- /.content -->
  <!-- </div> -->
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection

@script
   var visitorsData= JSON.parse('<?php echo $dashboard["allvisitorsbyCountry" ];?>');
@endscript