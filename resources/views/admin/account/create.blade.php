@extends('layouts.common.main')
@section('content') 


    <!-- Main content -->
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
        <!-- left column -->
        <div class="col-md-9">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create user account</h3>
            </div>
          
          <!-- Form Element sizes -->
          <div class="box box-success">
            <div class="box-body">
            <form action="{{route('account.create')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Enter name">
                @if ($errors->has('name'))
                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Enter email">
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
                  <label for="roles" class="control-label">Roles</label>
                    <select multiple="multiple" class="form-control js-example-basic-multiple" name="roles[]" id="roles">
                      @foreach ($roles as $values)
                      <option value="{{ $values->id }}"> {{ $values->name }}  </option>
                      @endforeach
                    </select>
                    <p class="help-block"></p>
                    @if($errors->has('roles'))
                        <p class="help-block">
                            {{ $errors->first('roles') }}
                        </p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="phone">Phone number</label>
                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" id="phone" placeholder="Phone Number">
                    @if ($errors->has('phone'))
                  <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                  @endif
                  </div>
                   <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" value="{{ old('address') }}" id="address"  placeholder="Enter Address">
                    @if ($errors->has('address'))
                  <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                  @endif
                  </div>

                  <div class="form-group">
                  <label for="is_login">Is Login:</label>
                  <label><input type="radio" name="is_login" value="1" checked>Active</label>
                  <label><input type="radio" name="is_login" value="2">Inactive</label>
                    @if ($errors->has('is_login'))
                <div class="alert alert-danger">{{ $errors->first('is_login') }}</div>
                @endif
                </div>

                   <div class="form-group">
                     <label for="Country">Country</label>
                    <select name="country" class="form-control">
                    <option value="">--Select--</option>
                    @foreach ($countries as $country)
                    
                      <option value="{{$country->id}}">{{$country->country}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('country'))
                  <div class="alert alert-danger">{{ $errors->first('country') }}</div>
                  @endif
                  </div>
                  <div class="form-group">
                <label>Date Of Birth:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="dob" class="form-control pull-right" id="datepicker">

                </div>
                @if ($errors->has('dob'))
                  <div class="alert alert-danger">{{ $errors->first('dob') }}</div>
                  @endif
                <!-- /.input group -->
              </div>
              <div class="form-group">
                  <label for="image">Profile Picture Upload</label>
                  <input type="file" class="form-control" name="image" id="image">
                  @if ($errors->has('image'))
                <div class="alert alert-danger">{{ $errors->first('image') }}</div>
                @endif
                </div>
              </div>
              <div class="form-group">
                  <label for="status">Status: </label>
                  <label><input type="radio" name="status" value="1" checked>Active</label>
                  <label><input type="radio" name="status" value="2">Inactive</label>
                  <label><input type="radio" name="status" value="3">Closed</label>
                  <label><input type="radio" name="status" value="4">Suspended</label>
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
          @endsection