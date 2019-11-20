@extends('layouts.common.main')
@section('content') 


    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Category</h3>

              <!-- <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div> -->
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('adminblogcategory.list')}}"><span class="glyphicon glyphicon-minus"></span> List All Category</a></li>
                <li class="{{ (request()->is('create/blogcategory')) ? 'active' : '' }}"><a href="{{route('adminblogcategory.create')}}"><span class="glyphicon glyphicon-minus"></span> Create Category</a></li>
                
              </ul>
            </div>
          <!-- /.box-body -->
          </div>
        </div>
        <!-- left column -->
        <div class="col-md-9">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create Category</h3>
            </div>
          <!-- Form Element sizes -->
          <div class="box box-success">
            <div class="box-body">
            <form action="{{route('adminblogcategory.create')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Enter Category">
                  @if ($errors->has('name'))
                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="description"> Description: </label>
                    <textarea name="description" class="form-control" rows="5" placeholder="Enter Description here..">{{old('description')}}</textarea>
                  @if ($errors->has('description'))
                <div class="alert alert-danger">{{ $errors->first('description') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="parent_id">Parent</label>
                    <select class="form-control"  name="parent_id" id="parent_id">
                      <option value="">none</option>
                      @foreach ($blogcategory as $values)
                      <option value="{{ $values->id }}"> {{ $values->name }}  </option>
                      @endforeach
                    </select>
                    <p class="help-block"></p>
                    @if($errors->has('parent_id'))
                        <p class="help-block">
                            {{ $errors->first('parent_id') }}
                        </p>
                    @endif
                </div>
                <div class="form-group">
                  <label for="slug">Slug</label>
                  <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}" placeholder="Enter Slug">
                  @if ($errors->has('slug'))
                <div class="alert alert-danger">{{ $errors->first('slug') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="tags">Tags</label>
                  <!-- value="{{ $tags }}" -->
                    <select multiple="multiple" class="form-control js-example-basic-multiple"  name="tags[]" id="tags" placeholder="Enter Tags">
                      @foreach ($tags as $values)
                      <option value="{{ $values->id }}"> {{ $values->name }}  </option>
                      @endforeach
                    </select>
                   
                    @if($errors->has('tags'))
                       <div class="alert alert-danger">
                            {{ $errors->first('tags') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                  <label for="priority">Priority</label>
                  <input type="number" class="form-control" name="priority" id="priority" placeholder="" value="{{old('priority')}}">
                  @if ($errors->has('priority'))
                  <div class="alert alert-danger">{{ $errors->first('priority') }}</div>
                  @endif
                </div>

                <div class="form-group">
                  <label for="status">Display:</label>
                  <label><input type="radio" name="status" value="1">Active</label>
                  <label><input type="radio" name="status" value="2">Inactive</label>
                  @if ($errors->has('status'))
                <div class="alert alert-danger">{{ $errors->first('status') }}</div>
                @endif
                </div>

                <div class="form-group">
                  <label for="show_in_home">Show in Home:</label>
                  <label><input type="radio" name="show_in_home" value="1">Active</label>
                  <label><input type="radio" name="show_in_home" value="2">Inactive</label>
                  @if ($errors->has('show_in_home'))
                  <div class="alert alert-danger">{{ $errors->first('show_in_home') }}</div>
                  @endif
                </div>

                <div class="form-group">
                  <label for="banner_image">Image Upload</label>
                  <input type="file" class="form-control" name="banner_image" id="banner_image">
                  @if ($errors->has('banner_image'))
                  <div class="alert alert-danger">{{ $errors->first('banner_image') }}</div>
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