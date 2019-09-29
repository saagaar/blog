@extends('layouts.common.main')
@section('content') 

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-3">
          <div class="box box-solid box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Notification</h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('notification.list')}}"><span class="glyphicon glyphicon-minus"></span> All blogs</a></li>
                <li class="{{ (request()->is('create/notification')) ? 'active' : '' }}"><a href="{{route('notification.create')}}"><span class="glyphicon glyphicon-plus"></span> Create Notification</a></li>
              </ul>
            </div>
          <!-- /.box-body -->
          </div>
        </div>
        <!-- left column -->
        <div class="col-md-9">
          <!-- general form elements -->
          <div class="box ">
            <div class="box-header">
              <h3 class="box-title">Create Notification</h3>
            </div>
          <!-- Form Element sizes -->
          <div class="box ">
            <div class="box-body">
            <form action="{{route('notification.create')}}" method="POST">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Title</label>
                  <input type="text" class="form-control" name="title" id="name" value="{{ old('title') }}" placeholder="Enter Title">
                  @if ($errors->has('title'))
                  <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                  @endif
                </div>                
                <div class="form-group">
                  <label for="code">Code:</label>
                  <input type="text" class="form-control" name="code" id="code" value="{{ old('code') }}" placeholder="Enter code">
                  @if ($errors->has('code'))
                  <div class="alert alert-danger">{{ $errors->first('code') }}</div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="subject">Subject:</label>
                  <input type="text" class="form-control" name="subject" id="subject" value="{{ old('subject') }}" placeholder="Enter subject">
                  @if ($errors->has('subject'))
                  <div class="alert alert-danger">{{ $errors->first('subject') }}</div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="view">view:</label>
                  <input type="text" class="form-control" name="view" id="view" value="default">
                  @if ($errors->has('view'))
                  <div class="alert alert-danger">{{ $errors->first('view') }}</div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="email_body">Email body: </label>
                    <textarea name="email_body" class="form-control" id="contenteditor" placeholder="Blog Email Body here.."></textarea>
                  @if ($errors->has('email_body'))
                <div class="alert alert-danger">{{ $errors->first('email_body') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="database_body">Database body: </label>
                    <textarea name="database_body" class="form-control" id="contenteditor" placeholder="Blog Database Body here.."></textarea>
                  @if ($errors->has('database_body'))
                <div class="alert alert-danger">{{ $errors->first('database_body') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="sms_body">Sms body: </label>
                    <textarea name="sms_body" class="form-control" id="contenteditor" placeholder="Blog sms Body here.."></textarea>
                  @if ($errors->has('sms_body'))
                <div class="alert alert-danger">{{ $errors->first('sms_body') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="notification_type">Notification Type:</label>
                  <select class="form-control" name="notification_type">
                      <option value="mail">Mail</option>
                      <option value="database">Database</option>
                      <option value="sms">Sms</option>
                  </select>
                  @if ($errors->has('notification_type')) 
                <div class="alert alert-danger">{{ $errors->first('notification_type') }}</div>
                @endif
                </div>
                  <div class="form-group">
                  <label for="active">Status: </label>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input flat-red" name="active"  value="1" checked>
                        <label class="custom-control-label" for="defaultChecked">Active</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input flat-red" name="active"  value="2" >
                        <label class="custom-control-label" for="defaultChecked">Inactive</label>
                      </div>
                  @if ($errors->has('active'))
                <div class="alert alert-danger">{{ $errors->first('active') }}</div>
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
        </div>
          <!-- /.box -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
      