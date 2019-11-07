  @extends('layouts.common.main')
@section('content') 
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-3">
          <div class="box box-solid box-primary">
             <div class="box-header with-border">
              <h3 class="box-title">Gallery Category</h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('gallerycategory.list')}}"><span class="glyphicon glyphicon-minus"></span> All Gallery Category list</a></li>
                <li class="{{ (request()->is('create/gallery/category')) ? 'active' : '' }}"><a href="{{route('gallerycategory.create')}}"><span class="glyphicon glyphicon-plus"></span> Create Gallery Category</a></li>
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
              <h3 class="box-title">Edit Gallery Category</h3>
            </div>
          <!-- Form Element sizes -->
          <div class="box ">
            <div class="box-body">
            <form action="{{route('gallerycategory.edit',$category->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" name="title" id="title" value="{{$category->title}}" placeholder="Enter title">
                  @if ($errors->has('title'))
                <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                @endif
                </div>

                <div class="form-group">
                  <label for="banner_image">Image Upload</label>
                 <img src='/uploads/gallery-cat-images/{{$category->banner_image}}' width="50"/>
                  <input type="file" class="form-control" name="banner_image" id="banner_image" value="{{$category->banner_image}}">
                  @if ($errors->has('banner_image'))
                <div class="alert alert-danger">{{$errors->first('banner_image') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                    <div class="custom-control custom-radio radio-inline">
                          <input type="radio" class="custom-control-input flat-red" name="status"  value="1" @if($category->status=='1') checked @endif>
                        <label class="custom-control-label" for="defaultChecked">Active</label>
                    </div>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="status"  value="2" @if($category->status=='2') checked @endif>
                        <label class="custom-control-label" for="defaultChecked">Inactive</label>
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
