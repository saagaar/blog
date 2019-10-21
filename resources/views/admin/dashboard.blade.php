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
               
                <h3><strong>Visitors</strong></h3>
                <hr style="border-color:#E3E3E3;">                          
                
            <!-- row -->    
            <div class="row">
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #b67782;color:white;"><span style="font-size:35px;font-weight:bold;">30</span><br>
                          TOTAL VISITORS
                      </div>
                    </div>
                </div>
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #3C8DBC;color:white;"><span style="font-size:35px;font-weight:bold;">10</span>
                          <br>VISITORS LOGIN TODAY
                      </div>
                    </div>
                </div>
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #F26161;color:white;"><span style="font-size:35px;font-weight:bold;">12</span> 
                          <br>REGISTERED TODAY
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
                      <div class="panel-body text-center" style="height:100px;background-color:#00A65A;color:white;"><span style="font-size:35px;font-weight:bold;">{{  $dashboard['allRegisteredUsers']}}</span> 
                          <br>TOTAL USERS
                      </div>
                    </div>
                </div>
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #374850;color:white;"><span style="font-size:35px;font-weight:bold;">{{$dashboard['loginUsers']}}</span> 
                          <br>USERS LOGIN TODAY</div>
                    </div>
                </div>
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #b67782;color:white;"><span style="font-size:35px;font-weight:bold;">{{$dashboard['allRegisteredUsers']}}</span> 
                          <br>REGISTERED TODAY
                       </div>
                    </div>
                </div>

            </div>
            <!-- row     -->

            <h3><strong>Blogs</strong></h3>
              <hr style="border-color:#E3E3E3;"> 
           <div class="row">
                <div class="col-xs-4">  
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #374850;color:white;"><span style="font-size:35px;font-weight:bold;">{{$dashboard['allBlogUsers']}}</span>
                        <br>TOTAL BLOGS
                      </div>
                    </div>
                </div>
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #b67782;color:white;"><span style="font-size:35px;font-weight:bold;">{{$dashboard['publishedBlogs']}}</span>
                          <br>PUBLISHED BLOGS
                      </div>
                    </div>
                </div>
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color:#00A65A;color:white;"><span style="font-size:35px;font-weight:bold;">{{$dashboard['savedBlogs']}}</span>
                          <br>SAVED BLOGS
                      </div>
                    </div>
                </div>

            </div>
            <!-- row -->

             <div class="row">
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #3C8DBC;color:white;"><span style="font-size:35px;font-weight:bold;">{{$dashboard['allBlogUsers']}}</span>
                        <br>TOTAL BLOGS   
                      </div>
                    </div>
                </div>
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #b67782;color:white;"><span style="font-size:35px;font-weight:bold;">{{$dashboard['publishedBlogs']}}</span><br>                       
                            PUBLISHED BLOGS
                      </div>
                    </div>
                </div>
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #F26161; color:white;"><span style="font-size:35px;font-weight:bold;">{{$dashboard['savedBlogs']}}</span> <br>                       
                          SAVED BLOGS
                      </div>
                    </div>
                </div>

            </div>
            <!-- row -->

              <div class="row">
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color:#00A65A;color:white;"><span style="font-size:35px;font-weight:bold;">{{$dashboard['allBlogUsers']}}</span> <br>                       
                          TOTAL BLOGS
                      </div>
                    </div>
                </div>
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #374850;color:white;"><span style="font-size:35px;font-weight:bold;">{{$dashboard['publishedBlogs']}}</span> <br>                       
                          PUBLISHED BLOGS
                      </div>
                    </div>
                </div>
                <div class="col-xs-4">
                   <div class="panel panel-default">
                      <div class="panel-body text-center" style="height:100px;background-color: #3C8DBC;color:white;"><span style="font-size:35px;font-weight:bold;">{{$dashboard['savedBlogs']}}</span><br>
                          SAVED BLOGS
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
