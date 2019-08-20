@extends('layouts.common.main')
@section('content') 
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-3">
          <div class="box box-solid box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> Edit contact</h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('contact.list')}}"><span class="glyphicon glyphicon-minus"></span> All contact</a></li>
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
              <h3 class="box-title">Edit contact</h3>
            </div>
          <!-- Form Element sizes -->
          <div class="box ">
            <div class="box-body">
            <form action="{{route('contact.edit',$contact->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="row">
                    <fieldset disabled>
                    <div class="form-group">
                      <label for="disabledTextInput"> Name</label>
                      <input type="text" id="disabledInput"  class="form-control" name="name" value="{{$contact->name}}" placeholder="Enter name">
                      @if ($errors->has('name'))
                    <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                    @endif
                    </div>
                    <div class="form-group">
                      <label for="phone">contact No</label>
                      <input type="text" class="form-control" name="phone"  id="disabledInput"  placeholder="Enter contact No" value="{{$contact->phone}}">
                      @if ($errors->has('phone'))
                    <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                    @endif
                    </div>
                    
                    <div class="form-group">
                      <label for="email"> Email</label>
                      <input type="text" disabled class="form-control" name="email" id="email" value="{{$contact->email}}" placeholder="Enter email">
                      @if ($errors->has('email'))
                    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                    @endif
                    </div>
                  <div class="form-group md-form">
                    <label for="subject">subject: </label>
                      <p>{{$contact->subject}}</p>
                  </div>
                  <div class="form-group">
                    <label for="message">Message: </label>
                    <div class="messagebox">
                      {{$contact->message}}
                    </div>
                      
                  </div>
                  </fieldset>
                    <div class="form-group">
                  <label for="status">Status</label>
                    <div class="custom-control custom-radio radio-inline">
                          <input type="radio" class="custom-control-input flat-red" name="status"  value="pending" @if($contact->status=='pending') checked @endif>
                        <label class="custom-control-label" for="defaultChecked">pending</label>
                    </div>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="status"  value="followup" @if($contact->status=='followup') checked @endif>
                        <label class="custom-control-label" for="defaultChecked">followup</label>
                      </div>
                      <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="status"  value="contacted" @if($contact->status=='contacted') checked @endif>
                        <label class="custom-control-label" for="defaultChecked">contacted</label>
                      </div>
                      <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="status"  value="closed" @if($contact->status=='closed') checked @endif>
                        <label class="custom-control-label" for="defaultChecked">closed</label>
                      </div>
                  @if ($errors->has('status'))
                  <div class="alert alert-danger">{{ $errors->first('status') }}</div>
                  @endif
                  </div>
                  <div class="form-group">
                    <label for="comment">comment: </label>
                      <textarea name="comment" rows="5" cols="25" id="comment" class="form-control" placeholder="Blog comment here..">
                        {{$contact->comment}}
                      </textarea>
                    @if ($errors->has('comment'))
                  <div class="alert alert-danger">{{ $errors->first('comment') }}</div>
                  @endif
                  </div>
                  <div class="form-group">
                    <label for="follow_date">Follow Date: </label>
                    <input type="text" class="form-control" name="follow_date" value="{{$contact->follow_date}}" id="datetimepicker" data-date-format="yyyy-mm-dd hh:ii">
                </div>
                   
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
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
      