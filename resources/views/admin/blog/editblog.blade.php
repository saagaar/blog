@extends('layouts.common.main')
@section('content') 
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-3">
          <div class="box box-solid box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Blog</h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('blog.list')}}"><span class="glyphicon glyphicon-minus"></span> All blogs</a></li>
                <li class="{{ (request()->is('create/blog')) ? 'active' : '' }}"><a href="{{route('blog.create')}}"><span class="glyphicon glyphicon-plus"></span> Create Blog</a></li>
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
              <h3 class="box-title">Create Blog</h3>
            </div>
          <!-- Form Element sizes -->
          <div class="box ">
            <div class="box-body">
            <form action="{{route('blog.edit',[$blog->id,str_slug($blog->title)])}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Title</label>
                  <input type="text" class="form-control" name="title" id="name"  placeholder="Enter Title" value="{{$blog->title}}">
                  @if ($errors->has('title'))
                <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="slug">Language</label>
                  <select class="form-control" name="locale_id">
                    @if(!empty($localelist))
                      @foreach($localelist as  $eachlocale)
                      <option value="{{$eachlocale['id']}}" @if($blog->locale_id==$eachlocale['id']) checked @endif >{{$eachlocale['lang_name']}}</option>
                      @endforeach
                    @endif

                  </select>
                  @if ($errors->has('locale_id')) 
                <div class="alert alert-danger">{{ $errors->first('locale_id') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="save_method">Save Method: </label>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input flat-red" name="save_method"  value="0" @if($blog->save_method==0) checked @endif>
                        <label class="custom-control-label" for="defaultChecked">Save to Draft</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input flat-red" name="save_method"  value="1" @if($blog->save_method==1) checked @endif>
                        <label class="custom-control-label" for="defaultChecked">Publish</label>
                      </div>
                  @if ($errors->has('save_method'))
                <div class="alert alert-danger">{{ $errors->first('save_methods') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="Content">Content: </label>
                    <textarea name="content" class="form-control" id="contenteditor" placeholder="Blog Content here..">{{$blog->content}}</textarea>
                  @if ($errors->has('content'))
                <div class="alert alert-danger">{{ $errors->first('content') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="image">Image Upload</label>
                  <img src="{{ asset('images/blogimages/'.$blog['image']) }}" alt="Blog Image" height="42" width="42">
                  <input type="file" class="form-control" name="image" id="image">
                  @if ($errors->has('image'))
                <div class="alert alert-danger">{{ $errors->first('image') }}</div>
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
          <!-- /.box -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
          @endsection
      