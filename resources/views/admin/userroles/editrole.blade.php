@extends('layouts.common.main')
@section('content') 
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">User Roles</h3>

              <!-- <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div> -->
            </div>
        
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('roles.list')}}"><span class="glyphicon glyphicon-minus"></span> List All User Roles</a></li>
                <li class="{{ (request()->is('create/role')) ? 'active' : '' }}"><a href="{{route('roles.create')}}"><span class="glyphicon glyphicon-minus"></span> Create User Roles</a></li>
                
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
              <h3 class="box-title">Edit User Role</h3>
            </div>
              
          <!-- Form Element sizes -->
          <div class="box box-success">
            <div class="box-body">
            <form action="{{route('roles.edit',$role->id)}}" method="POST">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Role Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ $role->name }}" placeholder="Enter Role">
                @if ($errors->has('name'))
                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                @endif
                </div>
                <!-- <div class="form-group">
                  <label for="guard_name">Guard Name</label>
                  <input type="text" class="form-control" name="guard_name" id="guard_name" value="{{ old('guard_name') }}" placeholder="Enter Guard name">
                @if ($errors->has('guard_name'))
                <div class="alert alert-danger">{{ $errors->first('guard_name') }}</div>
                @endif
                </div> -->
                <div class="form-group">
                  <label for="permissions">permissions</label>
                  <!-- value="{{ $permissions }}" -->
                    <select multiple="multiple" class="form-control select2"  name="permission[]" id="permission">
                      @foreach ($permissions as $values)
                      <option value="{{ $values->name }}"> {{ $values->name }}  </option>
                      @endforeach
                    </select>
                    <p class="help-block"></p>
                    @if($errors->has('permission'))
                        <p class="help-block">
                            {{ $errors->first('permission') }}
                        </p>
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