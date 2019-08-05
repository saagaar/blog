@extends('layouts.common.main')
@section('content') 


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Admin user</h3>

              <!-- <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div> -->
            </div>
            <!-- <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('adminuser.list')}}"><span class="glyphicon glyphicon-minus"></span> List All Admin user</a></li>
                <li class="{{ (request()->is('admin/createuser')) ? 'active' : '' }}"><a href="{{route('adminuser.create')}}"><span class="glyphicon glyphicon-minus"></span> Create Admin user</a></li>
                
              </ul>
            </div> -->
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- left column -->
        <div class="col-md-9">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Permission</h3>
            </div>
          
          <!-- Form Element sizes -->
          <div class="box box-success">
            <div class="box-body">
            <form action="{{route('adminuser.create')}}" method="POST">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="username" id="name" value="{{ old('username') }}" placeholder="Enter username">
                @if ($errors->has('username'))
                <div class="alert alert-danger">{{ $errors->first('username') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="email">Guard Name:</label>
                  <input type="text" class="form-control" name="guardname" id="guardname" value="{{ old('guardname') }}" placeholder="Enter guardname">
                @if ($errors->has('email'))
                <div class="alert alert-danger">{{ $errors->first('guardname') }}</div>
                @endif
                </div>
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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