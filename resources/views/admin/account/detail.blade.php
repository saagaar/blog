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
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/user-images/'.$account['image']) }}" alt="User profile picture">

              <h3 class="profile-username text-center">{{$account->name}}</h3>

              <p class="text-muted text-center">
              	@foreach ($account->roles()->pluck('name') as $role)
	                <span class="label label-info label-many">{{ $role }}</span>
	            @endforeach
	          </p>
            <p class="text-muted text-center">
                 <a href="{{route('account.edit',$account->id)}}"> <span class="label label-default label-many">Edit Profile</span></a>
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
              <strong><i class="fa fa-birthday-cake margin-r-5"></i> Date Of Birth</strong>

              <p class="text-muted">
                <?php echo date('F j, Y', strtotime($account->dob)); ?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>

              <p class="text-muted">{{$account->address }},@foreach ($account->country()->pluck('country') as $country)
                  {{ $country }}
              @endforeach</p>

              <hr>

              <strong><i class="fa fa-phone margin-r-5"></i> Phone</strong>

              <p class="text-muted">{{$account->phone }}</p>

              <hr>
              <strong><i class="fa fa-info-circle margin-r-5"></i> Status</strong>
              <p class="text-muted">
                    @if($account->status=='0')
                    <span class="label label-success">Active</span>
                    @elseif ($account->status=='1')
                    <span class="label label-danger">Inactive</span>
                    @elseif ($account->status=='2')
                    <span class="label label-warning">Closed</span>
                    @elseif ($account->status=='3')
                    <span class="label label-default">Suspended</span>
                    @endif</p>
                    
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