@extends('layouts.common.main')
@section('content') 
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Admin user</h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('adminuser.list')}}"><span class="glyphicon glyphicon-minus"></span> List All Admin user</a></li>
                
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- left column -->
        <div class="col-md-9">
          <!-- general form elements -->
          <div class="box ">
            <div class="box-header">
              <h3 class="box-title">Change Password</h3>
            </div>
          <!-- Form Element sizes -->
          <div class="box ">
            <div class="box-body">
            <form action="{{route('adminuser.change',$userId)}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                       <label for="old_password">Old Password</label>
                       <input type="password" class="form-control" name="old_password" id="old_password" placeholder="">
                       @if ($errors->has('old_password'))
                       <div class="alert alert-danger">{{ $errors->first('old_password') }}</div>
                       @endif
                    </div>

                    <div class="form-group">
                       <label for="password">New Password</label>
                       <input type="password" class="form-control" name="password" id="password" placeholder="">
                       @if ($errors->has('password'))
                       <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                       @endif
                    </div>

                    <div class="form-group">
                       <label for="confirm_password">Confirm Password</label>
                       <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="">
                       @if ($errors->has('confirm_password'))
                       <div class="alert alert-danger">{{ $errors->first('confirm_password') }}</div>
                       @endif
                    </div>

              </div>
              </div>                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Change</button>
              </div>
            </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
          @endsection