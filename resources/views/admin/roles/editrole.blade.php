@extends('layouts.common.main')
@section('content') 
    <section class="content">
      <div class="row">
        <div class="col-md-3">

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Admin Roles</h3>

              <!-- <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div> -->
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('adminrole.list')}}"><span class="glyphicon glyphicon-minus"></span> List All Admin Roles</a></li>
                <li class="{{ (request()->is('create/adminrole')) ? 'active' : '' }}"><a href="{{route('adminrole.create')}}"><span class="glyphicon glyphicon-minus"></span> Create Admin Roles</a></li>
                
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
              <h3 class="box-title">Edit Admin Roles</h3>
            </div>

          <!-- Form Element sizes -->
          <div class="box box-success">
            <div class="box-body">
            <form action="{{route('adminrole.edit',$adminrole->id) }}" method="POST">
            {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                <input type="hidden" value="{{csrf_token()}}" name="_token" />
                  <label for="name">Role Name</label>
                  <input type="text" class="form-control" name="role_name" id="name" value="{{$adminrole->role_name}}">
                  @if ($errors->has('role_name'))
                <div class="alert alert-danger">{{ $errors->first('role_name') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="slug">Slug</label>
                  <input type="text" class="form-control" name="slug" id="slug" value="{{$adminrole->slug}}">
                  @if ($errors->has('slug'))
                <div class="alert alert-danger">{{ $errors->first('slug') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="status">Status: &nbsp &nbsp &nbsp </label>
                  <label><input type="radio" name="status" value="1" {{ $adminrole->status == '1' ? 'checked' : ''}}>  Active</label>&nbsp
                  <label><input type="radio" name="status" value="0"  {{ $adminrole->status == '0' ? 'checked' : ''}}>  Inactive</label>
                </div>
                @if ($errors->has('status'))
                <div class="alert alert-danger">{{ $errors->first('status') }}</div>
                @endif
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