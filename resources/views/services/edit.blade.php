@extends('layouts.common.main')
@section('content') 

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-3">
          <div class="box box-solid box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Services</h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('services.list')}}"><span class="glyphicon glyphicon-minus"></span> All services list</a></li>
                <li class="{{ (request()->is('create/services')) ? 'active' : '' }}"><a href="{{route('services.create')}}"><span class="glyphicon glyphicon-plus"></span> Create services</a></li>
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
              <h3 class="box-title">Edit services</h3>
            </div>
          <!-- Form Element sizes -->
        <div class="box ">
          <div class="box-body">
            <form action="{{route('services.edit',$service->id)}}" method="POST" enctype="multipart/form-data"> 
              @csrf            
              <div class="box-body">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" name="title" id="title" value="{{$service->title}}" placeholder="Enter title">
                  @if ($errors->has('title'))
                  <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                  @endif
                </div>

                 <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control rounded-0" name="description" placeholder="Enter description" rows="6">
                 {{$service->description}}
                  </textarea>
                  @if ($errors->has('description'))
                  <div class="alert alert-danger">{{ $errors->first('description') }}</div>
                   @endif
                 </div>              
                <div class="form-group">
                  <label for="icon">Icon Upload</label>
                  
                  <input type="file" class="form-control" name="icon" id="icon" >
                  <img src='/images/services-images/{{$service->icon}}'width="30">

                  @if ($errors->has('icon'))
                  <div class="alert alert-danger">{{ $errors->first('icon') }}</div>
                  @endif
                </div>

                 <div class="form-group">
                  <label for="status">Status</label>
                    <div class="custom-control custom-radio radio-inline">
                          <input type="radio" class="custom-control-input flat-red" name="status"  value="1" @if($service->status=='1') checked @endif>
                        <label class="custom-control-label" for="defaultChecked">Yes</label>
                    </div>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="status"  value="0" @if($service->status=='0') checked @endif>
                        <label class="custom-control-label" for="defaultChecked">No</label>
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
      