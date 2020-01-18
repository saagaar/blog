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
            <form action="{{route('notification.edit',$notification->id)}}" method="POST">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Title</label>
                  <input type="text" class="form-control" name="title" id="name" value="{{ $notification->title }}" placeholder="Enter Title">
                  @if ($errors->has('title'))
                  <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                  @endif
                </div>                
                <div class="form-group">
                  <label for="code">Code:</label>
                  <input type="text" class="form-control" name="code" id="code" value="{{ $notification->code }}" placeholder="Enter code">
                  @if ($errors->has('code'))
                  <div class="alert alert-danger">{{ $errors->first('code') }}</div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="subject">Subject:</label>
                  <input type="text" class="form-control" name="subject" id="subject" value="{{ $notification->subject }}" placeholder="Enter subject">
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
                  <label for="notification_type">Notification Type:</label>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" @if(is_array($notification->notification_type) && in_array('mail',$notification->notification_type)) checked @endif name="notification_type[]" value="mail">
                      Mail
                    </label>
                    <label>
                      <input type="checkbox" @if(is_array($notification->notification_type) && in_array('database',$notification->notification_type)) checked @endif name="notification_type[]" value="database"  id="myCheck"  onclick="showFunction()">
                      Database
                    </label>
                    <label>
                      <input type="checkbox" @if(is_array($notification->notification_type) &&  in_array('sms',$notification->notification_type)) checked @endif name="notification_type[]" value="sms" id="myChecksms"  onclick="showSmsFunction()">
                      Sms
                    </label>
                  </div>
                  @if ($errors->has('notification_type')) 
                <div class="alert alert-danger">{{ $errors->first('notification_type') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="email_body">Email body: </label>
                    <textarea name="email_body" class="form-control" id="contenteditor" placeholder="Blog Email Body here..">{{ $notification->email_body }}</textarea>
                  @if ($errors->has('email_body'))
                <div class="alert alert-danger">{{ $errors->first('email_body') }}</div>
                @endif
                </div>
                <div class="form-group"  id="emaildb" style="display:none">
                  <label for="database_body">Database body: </label>
                    <textarea name="database_body" class="form-control" id="contenteditor" placeholder="Blog Database Body here..">{{ $notification->database_body }}</textarea>
                  @if ($errors->has('database_body'))
                <div class="alert alert-danger">{{ $errors->first('database_body') }}</div>
                @endif
                </div>
                <div class="form-group" id="emailsms" style="display:none">
                  <label for="sms_body">Sms body: </label>
                    <textarea name="sms_body" class="form-control" id="contenteditor" placeholder="Blog sms Body here..">{{ $notification->sms_body }}</textarea>
                  @if ($errors->has('sms_body'))
                <div class="alert alert-danger">{{ $errors->first('sms_body') }}</div>
                @endif
                </div>
                
                  <div class="form-group">
                  <label for="active">Status: </label>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input flat-red" name="active"  value="1" @if($notification->active==1) checked @endif>
                        <label class="custom-control-label" for="defaultChecked">Active</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input flat-red" name="active"  value="2" @if($notification->active==2) checked @endif >
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
      