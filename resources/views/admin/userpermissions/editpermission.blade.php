@extends('layouts.common.main')
@section('content') 


    <!-- Main content -->
    <section class="content">
      <div class="row"> 
        <div class="col-md-3">

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Permission Edit</h3>

              <!-- <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div> -->
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('permission.list')}}"><span class="glyphicon glyphicon-minus"></span> List All Edited permissions</a></li>
                <li class="{{ (request()->is('create/Permission')) ? 'active' : '' }}"><a href="{{route('permission.create')}}"><span class="glyphicon glyphicon-minus"></span> Edit permission users</a></li>
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
              <h3 class="box-title"> Edit Permission</h3>
            </div>
          
          <!-- Form Element sizes -->
          <div class="box box-success">
            <div class="box-body">
            <form action="{{ route('permission.edit',$permissions->id) }}" method="POST">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ $permissions->name }}" placeholder="Enter name">
                @if ($errors->has('name'))
                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                @endif
                </div>
               <!--  <div class="form-group">
                  <label for="guard_name">Guard Name:</label>
                  <input type="text" class="form-control" name="guard_name" id="guard_name" value="{{ $permissions->guard_name }}" placeholder="Enter guard name">
                @if ($errors->has('guard_name'))
                <div class="alert alert-danger">{{ $errors->first('guard_name') }}</div>
                @endif
                </div> -->
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Edit</button>
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