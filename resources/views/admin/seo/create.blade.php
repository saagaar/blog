@extends('layouts.common.main')
@section('content') 
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-3">
          <div class="box box-solid box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">SEO Management</h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('seo.list')}}"><span class="glyphicon glyphicon-minus"></span> All Seo</a></li>
                <li class="{{ (request()->is('create/seo')) ? 'active' : '' }}"><a href="{{route('seo.create')}}"><span class="glyphicon glyphicon-plus"></span> Create New Seo</a></li>
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
              <h3 class="box-title">Create Seo</h3>
            </div>
          <!-- Form Element sizes -->
          <div class="box ">
            <div class="box-body">
            <form action="{{route('seo.create')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="pageid">Page Name</label>
                  <input type="text" class="form-control" name="pageid" id="pageid" value="{{ old('pageid') }}" placeholder="Enter Page Name">
                  @if ($errors->has('pageid'))
                <div class="alert alert-danger">{{ $errors->first('pageid') }}</div>
                @endif
                </div>
                  <div class="form-group">
                  <label for="page_slug">Page Slug</label>
                  <input type="text" class="form-control" name="page_slug" id="page_slug" value="{{  old('page_slug') }}" placeholder="Enter Page Slug">
                  @if ($errors->has('page_slug'))
                <div class="alert alert-danger">{{ $errors->first('page_slug') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="meta_title">Meta Title</label>
                  <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" placeholder="Enter meta title">
                  @if ($errors->has('meta_title'))
                <div class="alert alert-danger">{{ $errors->first('meta_title') }}</div>
                @endif
                </div>
              
                <div class="form-group">
                  <label for="meta_key">Meta Key</label>
                  <input type="text" class="form-control" name="meta_key" id="meta_key" value="{{ old('meta_key') }}" placeholder="Enter Meta Key">
                  @if ($errors->has('meta_key'))
                <div class="alert alert-danger">{{ $errors->first('meta_key') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="meta_description">Meta Description: </label>
                    <textarea name="meta_description" class="form-control" rows="5" placeholder="Meta Description here..">{{old('meta_description')}}</textarea>
                  @if ($errors->has('meta_description'))
                <div class="alert alert-danger">{{ $errors->first('meta_description') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="schema1">schema1</label>
                  <textarea name="schema1" class="form-control" rows="8" placeholder="Schema1 here..">{{old('schema1')}}</textarea>
                                      
                  @if ($errors->has('schema1'))
                <div class="alert alert-danger">{{ $errors->first('schema1') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="schema2">schema2</label>
                  <textarea name="schema2" class="form-control" rows="8" placeholder="Schema2 here..">{{old('schema2')}}</textarea>                 
                  @if ($errors->has('schema2'))
                <div class="alert alert-danger">{{ $errors->first('schema2') }}</div>
                @endif
                </div>
                 <div class="form-group">                  
                  <label for="image">Image Upload</label>                  
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
      