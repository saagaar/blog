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
                <li class="{{ (request()->is('admin/createuser')) ? 'active' : '' }}"><a href="{{route('account.create')}}"><span class="glyphicon glyphicon-minus"></span> create User Account</a></li>
                
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
              <h3 class="box-title">Edit user</h3>
            </div>
          
          <!-- Form Element sizes -->
          <div class="box box-success">
            <div class="box-body">
            <form action="{{ route('account.edit' , $accounts->id)}}" method="POST"  enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{$accounts->name}}" >
                @if ($errors->has('name'))
                <div class="active">{{ $errors->first('name') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" name="email" id="email" value="{{$accounts->email}}">
                @if ($errors->has('email'))
                <div class="active">{{ $errors->first('email') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                @if ($errors->has('password'))
                <div class="active">{{ $errors->first('password') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="password_confirmation">Password Confirmation</label>
                  <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Enter password again">
                </div>
                <div class="form-group">
                  <label for="roles" class="control-label">Roles</label>
                  <!-- value="{{ $roles }}" -->
                    <select multiple="multiple" class="form-control js-example-basic-multiple"  name="roles[]" id="roles">
                      @if($accounts->roles()->pluck('name'))
                           @foreach ($accounts->roles()->get() as $rol)
                                        <option value="{{ $rol->id }}"selected>{{ $rol->name }}</option>
                                    @endforeach
                    @endif
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
                    <input type="text" class="form-control" name="phone" value="{{$accounts->email}}" id="phone" placeholder="Phone Number">
                    @if ($errors->has('phone'))
                  <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                  @endif
                  </div>

                  <div class="form-group">
                  <label for="is_login">Is Login:</label>
                  <label><input type="radio" name="is_login" value="1" {{ $accounts->is_login == '1' ? 'checked' : ''}} checked>Active</label>
                  <label><input type="radio" name="is_login" value="2" {{ $accounts->is_login == '2' ? 'checked' : ''}}>Inactive</label>
                    @if ($errors->has('is_login'))
                    <div class="alert alert-danger">{{ $errors->first('is_login') }}</div>
                    @endif
                    </div>                
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" value="{{$accounts->address}}" id="address"  placeholder="Enter Address">
                    @if ($errors->has('address'))
                  <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                  @endif
                  </div>
                   <div class="form-group">
                     <label for="Country">Country</label>
                    <select name="country" class="form-control">
                      @if($accounts->country)
                       @foreach ($accounts->country()->get() as $country)
                                        <option value="{{ $country->id }}">{{ $country->country }}</option>
                                    @endforeach
                        @else
                    <option value="">--Select--</option>
                    @endif
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
                  <input type="text" value="{{$accounts->dob}}" name="dob" class="form-control pull-right" id="datepicker">

                </div>
                @if ($errors->has('dob'))
                  <div class="alert alert-danger">{{ $errors->first('dob') }}</div>
                  @endif
                <!-- /.input group -->
              </div>
                  <div class="form-group">
                  <label for="image">Profile Picture</label>
                    <div class="text-left">
                      <img src="{{ asset('uploads/user-images/'.$accounts->image) }}" class="avatar img-circle" alt="Profile Picture" height="90" width="90">
                  
                      <h6>Upload a different photo...</h6>
                      <input type="file" class="form-control" name="image" id="image">
                    </div>
                  
                  @if ($errors->has('image'))
                <div class="alert alert-danger">{{ $errors->first('image') }}</div>
                @endif
                </div>
              </div>
              <div class="form-group">
                  <label for="status">Status: </label>
                  <label><input type="radio" name="status" value="1" {{ $accounts->status == '1' ? 'checked' : ''}}>Active</label>
                  <label><input type="radio" name="status" value="2" {{ $accounts->status == '2' ? 'checked' : ''}}>Inactive</label>
                  <label><input type="radio" name="status" value="3" {{ $accounts->status == '3' ? 'checked' : ''}}>Closed</label>
                  <label><input type="radio" name="status" value="4" {{ $accounts->status == '4' ? 'checked' : ''}}>Suspended</label>
                </div>
                @if ($errors->has('status'))
                <div class="active">{{ $errors->first('status') }}</div>
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
  </div>
          @endsection