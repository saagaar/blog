@extends('layouts.common.main')
@section('content') 


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">User Permission</h3>

            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('permission.list')}}"><span class="glyphicon glyphicon-minus"></span> List All User Permission</a></li>
                <li class="{{ (request()->is('create/Permission')) ? 'active' : '' }}"><a href="{{route('permission.create')}}"><span class="glyphicon glyphicon-minus"></span> Create Users Permissions</a></li>
                
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- left column -->
        <div class="col-md-9">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> Create Users Permissions</h3>
            </div>
          
          <!-- Form Element sizes -->
          <div class="box box-success">
            <div class="box-body">
            <form action="{{route('permission.create')}}" method="POST">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Enter name">
                @if ($errors->has('name'))
                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                @endif
                </div>
              </div>
              <div class="form-group">
                  <label for="default">Default</label>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="default" value="1">
                        <label class="custom-control-label" for="defaultChecked">Yes</label>
                    </div>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="default" value="2" checked>
                        <label class="custom-control-label" for="defaultChecked">No</label>
                    </div>
                         @if ($errors->has('default'))
                         <div class="alert alert-danger">{{ $errors->first('default') }}</div>
                         @endif
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