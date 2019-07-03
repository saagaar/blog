@extends('layouts.common.main')
@section('content') 
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Admin Users
        <small>Create</small>
      </h1>
      @include('includes.breadcrumbs', ['breadcrumbs' => [
    'Dashboard' => route('admin.dashboard'),
    'Admin Users' => route('adminuser.list'),
    'Create',
      ]])
    </section>

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
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('adminuser.list')}}"><span class="glyphicon glyphicon-minus"></span> List All Admin user</a></li>
                <li class="{{ (request()->is('admin/createuser')) ? 'active' : '' }}"><a href="{{route('adminuser.create')}}"><span class="glyphicon glyphicon-minus"></span> Create Admin user</a></li>
                
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
              <h3 class="box-title">Create user</h3>
            </div>
          
          <!-- Form Element sizes -->
          <div class="box box-success">
            <div class="box-body">
            <form action="{{route('adminuser.create')}}" method="POST">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="username" id="name" placeholder="Enter username">
                @if ($errors->has('username'))
                <div class="alert alert-danger">{{ $errors->first('username') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                @if ($errors->has('email'))
                <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                @if ($errors->has('password'))
                <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="password_confirmation">Password Confirmation</label>
                  <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Enter password again">
                  @if ($errors->has('password_confirmation'))
                <div class="alert alert-danger">{{ $errors->first('password_confirmation') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label>Role</label>
                 
                  <select name="role_id" class="form-control">
                  <option value="">--Select--</option>
                  @foreach ($adminroles as $role)
                  
                    <option value="{{$role->id}}">{{$role->role_name}}</option>
                    @endforeach
                  </select>
                 
                </div>
                @if ($errors->has('role_id'))
                <div class="alert alert-danger">{{ $errors->first('role_id') }}</div>
                @endif
              </div>
              <div class="form-group">
                  <label for="status">Status: </label>
                  <label><input type="radio" name="status" value="0">Active</label>
                  <label><input type="radio" name="status" value="1">Inactive</label>
                </div>
                @if ($errors->has('status'))
                <div class="alert alert-danger">{{ $errors->first('status') }}</div>
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
  </div>
          @endsection