@extends('layouts.common.main')
@section('content') 
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Banners</h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('banner.list')}}"><span class="glyphicon glyphicon-minus"></span> All Banners list</a></li>
                <li class="{{ (request()->is('create/banner')) ? 'active' : '' }}"><a href="{{route('banner.create')}}"><span class="glyphicon glyphicon-plus"></span> Create Banner</a></li>
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
              <h3 class="box-title">Edit Banner</h3>
            </div>
          <!-- Form Element sizes -->
          <div class="box ">
            <div class="box-body">
            <form action="{{route('banner.edit',$banner->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                       <label for="title">Title</label>
                       <input type="text" class="form-control" name="title" id="title" value="{{$banner->title}}" placeholder="Enter Title">
                       @if ($errors->has('title'))
                       <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                       @endif
                    </div>
                
                  <div class="form-group">
                      <label for="description">Description: </label>
                       <textarea name="description" class="form-control" rows="5" placeholder="Enter Description">{{$banner->description}}</textarea>
                        @if ($errors->has('description'))
                        <div class="alert alert-danger">{{ $errors->first('description') }}</div>
                        @endif
                    </div>  
                  <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea name="content" class="form-control" id="contenteditor" placeholder="Banner Content here..">
                    {{$banner->content}}
                    </textarea>
                    @if ($errors->has('content'))
                    <div class="alert alert-danger">{{ $errors->first('content') }}</div>
                    @endif
                  </div>  
                <div class="form-group">
                       <label for="type">Type</label>
                       <input type="text" class="form-control" name="type" id="type" value="{{$banner->type}}" placeholder="Enter Type">
                       @if ($errors->has('type'))
                       <div class="alert alert-danger">{{ $errors->first('type') }}</div>
                       @endif
                    </div>
                  <div class="form-group">
                       <label for="url">URL</label>
                       <input type="text" class="form-control" name="url" id="url" value="{{$banner->url}}" placeholder="Enter URL">
                       @if ($errors->has('url'))
                       <div class="alert alert-danger">{{ $errors->first('url') }}</div>
                       @endif
                    </div>    

                <div class="form-group">
                  <label for="display_order">Display Order</label>
                  <input type="number" class="form-control" name="display_order" id="display_order" placeholder="Enter the display order" value="{{$banner->display_order}}">
                  @if ($errors->has('display_order'))
                  <div class="alert alert-danger">{{ $errors->first('display_order') }}</div>
                  @endif
                </div>

              <div class="form-group">
                  <label for="image">Image Upload</label>
                  <input type="file" class="form-control" name="image" id="image">
                  <img src='/uploads/banner-images/{{$banner->image}}' width="50"/>
                  @if ($errors->has('image'))
                  <div class="alert alert-danger">{{ $errors->first('image') }}</div>
                  @endif  
                </div>                
              </div>
              </div>                

               <div class="form-group">
                  <label for="status">Status</label>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="status" value="1" @if($banner->status=='1')checked @endif>
                        <label class="custom-control-label" for="defaultChecked">Publish</label>
                    </div>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="status" value="2" @if($banner->status=='2')checked @endif >
                        <label class="custom-control-label" for="defaultChecked">Unpublish</label>
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
      