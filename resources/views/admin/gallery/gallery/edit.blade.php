@extends('layouts.common.main')
@section('content') 
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-3">
          <div class="box box-solid box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Gallery </h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('gallery.list')}}"><span class="glyphicon glyphicon-minus"></span> All Gallery  list</a></li>
                <li class="{{ (request()->is('create/gallery')) ? 'active' : '' }}"><a href="{{route('gallery.create')}}"><span class="glyphicon glyphicon-plus"></span> Create Gallery </a></li>
              </ul>
            </div>
          <!-- /.box-body -->
          </div>
        </div>
        <!-- <?php  print_r($errors->all()); ?> -->
        <!-- left column -->
        <div class="col-md-9">
          <!-- general form elements -->
          <div class="box ">
            <div class="box-header">
              <h3 class="box-title">Edit Gallery Image</h3>
            </div>
          <!-- Form Element sizes -->
        <div class="box ">
          <div class="box-body">
            <form action="{{route('gallery.edit',$gallery->id)}}" method="POST" enctype="multipart/form-data"> 
              @csrf            
              <div class="box-body">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" name="title" id="title" value="{{ $gallery->title }}" placeholder="Enter title">
                  @if ($errors->has('title'))
                  <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                  @endif
                </div>
                <div class="form-group">
                  <label>Gallery Category</label>
                 
                  <select name="categories_id" class="form-control">
                  	 @if($gallery->categories)
                       @foreach ($gallery->categories()->get() as $selected)
                                        <option value="{{ $selected->id }}">{{ $selected->title }}</option>
                                    @endforeach
                        @endif
                  @foreach ($category as $cat)                  
                    <option value="{{$cat->id}}">{{$cat->title}}</option>
                    @endforeach
                  </select>
                 @if ($errors->has('categories_id'))
                <div class="alert alert-danger">{{ $errors->first('categories_id') }}</div>
                @endif
                </div>
                
                <div class="form-group">
                  <label for="image">Image Upload</label>
                  <img src="{{ asset('/images/gallery/'.$gallery['image']) }}" alt="{{ $gallery->title }}" height="42" width="42">
                  <input type="file" class="form-control" name="image" id="image" multiple>
                  @if ($errors->has('image'))
                  <div class="alert alert-danger">{{ $errors->first('image') }}</div>
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
      