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
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $dashboard['activeUsers']}}</h3>

              <p>Active Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="/admin/list/account" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $dashboard['publishedBlogs']}}<sup style="font-size: 20px"></sup></h3>

              <p>Total Published Blogs</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/admin/list/blog" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $dashboard['allRegisteredUsers']}}</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="/admin/list/account" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $dashboard['allVisitors']}}</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
              <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <!-- <div class="box box-success">
            <div class="box-header">
              <i class="fa fa-comments-o"></i>

              <h3 class="box-title">Chat</h3>

              <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                <div class="btn-group" data-toggle="btn-toggle">
                  <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                </div>
              </div>
            </div>
            <div class="box-body chat" id="chat-box">
              <div class="item">
                <img src="dist/img/user4-128x128.jpg" alt="user image" class="online">

                <p class="message">
                  <a href="#" class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                    Mike Doe
                  </a>
                  I would like to meet you to discuss the latest news about
                  the arrival of the new theme. They say it is going to be one the
                  best themes on the market
                </p>
                <div class="attachment">
                  <h4>Attachments:</h4>

                  <p class="filename">
                    Theme-thumbnail-image.jpg
                  </p>

                  <div class="pull-right">
                    <button type="button" class="btn btn-primary btn-sm btn-flat">Open</button>
                  </div>
                </div>
              </div>
              <div class="item">
                <img src="dist/img/user3-128x128.jpg" alt="user image" class="offline">

                <p class="message">
                  <a href="#" class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
                    Alexander Pierce
                  </a>
                  I would like to meet you to discuss the latest news about
                  the arrival of the new theme. They say it is going to be one the
                  best themes on the market
                </p>
              </div>
              <div class="item">
                <img src="dist/img/user2-160x160.jpg" alt="user image" class="offline">

                <p class="message">
                  <a href="#" class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
                    Susan Doe
                  </a>
                  I would like to meet you to discuss the latest news about
                  the arrival of the new theme. They say it is going to be one the
                  best themes on the market
                </p>
              </div>
            </div>
            <div class="box-footer">
              <div class="input-group">
                <input class="form-control" placeholder="Type message...">

                <div class="input-group-btn">
                  <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
                </div>
              </div>
            </div>
          </div>-->
          <!-- /.box (chat box) -->

          <!-- TO DO List -->
          <!--<div  class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">To Do List</h3>

              <div class="box-tools pull-right">
                <ul class="pagination pagination-sm inline">
                  <li><a href="#">&laquo;</a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <div class="box-body">
              <ul class="todo-list">
                <li>
                  <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Design a nice theme</span>
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Make the theme responsive</span>
                  <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Check your messages and notifications</span>
                  <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
              </ul>
            </div>
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
            </div>
          </div> -->
          <!-- /.box -->

          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Quick Email</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <form action="/admin/sendemail" method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="email"  placeholder="Email to:">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" placeholder="Subject">
                </div>
                <div>
                  <textarea class="textarea" id="contenteditor" placeholder="Message" name="emailbody" 
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </form>
            </div>
            <div class="box-footer clearfix">
              <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- Map box -->
          <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip"
                        title="Date range">
                  <i class="fa fa-calendar"></i></button>
                <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse"
                        data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->

              <i class="fa fa-map-marker"></i>

              <h3 class="box-title">
                Visitors
              </h3>
            </div>
            <div class="box-body">
              <div id="world-map" style="height: 250px; width: 100%;"></div>
            </div>
            <!-- /.box-body-->
            <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-1"></div>
                  <div class="knob-label">Visitors</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-2"></div>
                  <div class="knob-label">Online</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center">
                  <div id="sparkline-3"></div>
                  <div class="knob-label">Exists</div>
                </div>
                <!-- ./col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.box -->

          <!-- solid sales graph -->
          <div class="box box-solid bg-teal-gradient">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Sales Graph</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <div class="box-body border-radius-none">
              <div class="chart" id="line-chart" style="height: 250px;"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                         data-fgColor="#39CCCC">

                  <div class="knob-label">Mail-Orders</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                         data-fgColor="#39CCCC">

                  <div class="knob-label">Online</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center">
                  <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                         data-fgColor="#39CCCC">

                  <div class="knob-label">In-Store</div>
                </div>
                <!-- ./col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->

          <!-- Calendar -->
          <div class="box box-solid bg-green-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Calendar</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <div class="btn-group">
                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i></button>
                  <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="#">Add new event</a></li>
                    <li><a href="#">Clear events</a></li>
                    <li class="divider"></li>
                    <li><a href="#">View calendar</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-black">
              <div class="row">
                <div class="col-sm-6">
                  <!-- Progress bars -->
                  <div class="clearfix">
                    <span class="pull-left">Task #1</span>
                    <small class="pull-right">90%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                  </div>

                  <div class="clearfix">
                    <span class="pull-left">Task #2</span>
                    <small class="pull-right">70%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                  <div class="clearfix">
                    <span class="pull-left">Task #3</span>
                    <small class="pull-right">60%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                  </div>

                  <div class="clearfix">
                    <span class="pull-left">Task #4</span>
                    <small class="pull-right">40%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->




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
<script type="text/javascript">
   var visitorsData= JSON.parse('<?php echo $dashboard["allvisitorsbyCountry" ];?>');
</script>