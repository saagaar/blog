@extends('layouts.common.main')
@section('content') 
<section class="content">

      <div class="row">
      	<div class="col-md-3">

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">User Account</h3>

              <!-- <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div> -->
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('account.list')}}"><span class="glyphicon glyphicon-minus"></span> List All User Account</a></li>
                <li class="{{ (request()->is('create/account')) ? 'active' : '' }}"><a href="{{route('account.create')}}"><span class="glyphicon glyphicon-minus"></span> Create User Account</a></li>
                
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <div class="col-md-9">

          <!-- Profile Image -->
          <div class="box box-body">
            <div class="box-body box-profile col-md-3">
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/userimages/'.$account['image']) }}" alt="User profile picture">

              <h3 class="profile-username text-center">{{$account->name}}</h3>

              <p class="text-muted text-center">
              	@foreach ($account->roles()->pluck('name') as $role)
	                <span class="label label-info label-many">{{ $role }}</span>
	            @endforeach
	          </p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-body">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
@endsection