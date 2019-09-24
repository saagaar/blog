@extends('layouts.common.main')
@section('content') 
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Subscription Manager</h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('subscription.list')}}"><span class="glyphicon glyphicon-minus"></span> All Subscription Manager</a></li>
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
              <h3 class="box-title">Edit Subscription Manager</h3>
            </div>
          <!-- Form Element sizes -->
          <div class="box ">
            <div class="box-body">
            <form action="{{route('subscription.edit',$subscription->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="email">Email</label>
                        <div class="email">                         
                         {{$subscription->email}}
                        </div>
                      </div>                                
                  </div>
                </div>        

                 <div class="form-group">
                  <label for="comment">Comment</label>
                  <textarea class="form-control rounded-0" name="comment" placeholder="Enter comment" rows="6">
                  {{$subscription->comment}}
                  </textarea>
                  @if ($errors->has('comment'))
                  <div class="alert alert-danger">{{ $errors->first('comment') }}</div>
                   @endif
                 </div>                                 

               <div class="form-group">
                  <label for="status">Status</label>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="status" value="1" @if($subscription->status=='1') checked @endif>
                        <label class="custom-control-label" for="defaultChecked">Subscribed</label>
                    </div>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="status" value="2"  @if($subscription->status=='2') checked @endif >
                        <label class="custom-control-label" for="defaultChecked">Unsubscribed</label>
                    </div>
                         @if ($errors->has('status'))
                         <div class="alert alert-danger">{{ $errors->first('status') }}</div>
                         @endif
                  </div>
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
      