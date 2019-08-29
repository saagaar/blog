    @extends('layouts.common.main')
@section('content') 
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-3">
          <div class="box box-solid box-primary">
             <div class="box-header with-border">
              <h3 class="box-title">Testimonials</h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('testimonial.list')}}"><span class="glyphicon glyphicon-minus"></span> All testimonials list</a></li>
                <li class="{{ (request()->is('create/testimonial')) ? 'active' : '' }}"><a href="{{route('testimonial.create')}}"><span class="glyphicon glyphicon-plus"></span> Create testimonials</a></li>
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
              <h3 class="box-title">Edit Testimonials</h3>
            </div>
          <!-- Form Element sizes -->
          <div class="box ">
            <div class="box-body">
            <form action="{{route('testimonial.edit',$testimony->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{$testimony->name}}" placeholder="Enter Name">
                  @if ($errors->has('name'))
                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                @endif
                </div>

                <div class="form-group">
                  <label for="name">Position</label>
                  <input type="text" class="form-control" name="position" id="position" value=" {{$testimony->position }}" placeholder="Enter Name">
                  @if ($errors->has('position'))
                <div class="alert alert-danger">{{ $errors->first('position') }}</div>
                @endif
                </div>

                 <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control rounded-0" name="description" placeholder="Enter description" rows="6">
                 {{$testimony->description }}
                  </textarea>
                  @if ($errors->has('description'))
                <div class="alert alert-danger">{{ $errors->first('description') }}</div>
                @endif
                </div>              
                <div class="form-group">
                  <label for="image">Image Upload</label>
                  <input type="file" class="form-control" name="image" id="image"/>
                  <img src='frontend/images/testimonial-images/{{$testimony->image}}' width="50">

                  @if ($errors->has('image'))
                <div class="alert alert-danger">{{$errors->first('image') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                    <div class="custom-control custom-radio radio-inline">
                          <input type="radio" class="custom-control-input flat-red" name="status"  value="1" @if($testimony->status=='1') checked @endif>
                        <label class="custom-control-label" for="defaultChecked">Yes</label>
                    </div>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="status"  value="0" @if($testimony->status=='0') checked @endif>
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
