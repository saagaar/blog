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
                <li class="{{ (request()->is('/create/blogcategory')) ? 'active' : '' }}"><a href="{{route('adminblogcategory.create')}}"><span class="glyphicon glyphicon-minus"></span> Create Category</a></li>
                
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
              <h3 class="box-title">Edit Category</h3>
            </div>

          <!-- Form Element sizes -->
          <div class="box box-success">
            <div class="box-body">
            <form action="{{route('adminblogcategory.edit',$category->id)}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                <input type="hidden" value="{{csrf_token()}}" name="_token" />
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{$category->name}}" placeholder="Enter Help Category">
                  @if ($errors->has('name'))
                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="parent_id">Parent</label>
                    <select class="form-control"  name="parent_id" id="parent_id">
                      <?php print_r($blogcategory); ?>
                      @foreach ($blogcategory as $values)
                      <option value="">none</option>
                      <option value="{{ $values->id }}" @if($values->id==$category->parent_id) selected @endif > {{ $values->name }}  </option>
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
                  <input type="text" class="form-control" name="slug" id="slug" value="{{$category->slug}}" placeholder="Enter Help Category">
                  @if ($errors->has('slug'))
                <div class="alert alert-danger">{{ $errors->first('slug') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="tags">Tags</label>
                  <!-- value="{{ $tags }}" -->
                    <select multiple="multiple" class="form-control js-example-basic-multiple"  name="tags[]" id="tags">
                      @foreach ($tags as $values)
                            <option value="{{ $values->id }}"> {{ $values->name }}  </option>
                      @endforeach
                    </select>
                    <p class="help-block"></p>
                    @if($errors->has('tags'))
                        <p class="help-block">
                            {{ $errors->first('tags') }}
                        </p>
                    @endif
                </div>
                <div class="form-group">
                  <label for="priority">Priority</label>
                  <input type="number" class="form-control" name="priority" id="priority" placeholder="" value="{{$category->priority}}">
                  @if ($errors->has('priority'))
                  <div class="alert alert-danger">{{ $errors->first('priority') }}</div>
                  @endif
                </div>

                <div class="form-group">
                  <label for="status">Display:</label>
                  <label><input type="radio" name="status" value="1" @if($category->status=='1') checked @endif >Active</label>
                  <label><input type="radio" name="status" value="2" @if($category->status=='2') checked @endif >Inactive</label>
                  @if ($errors->has('status'))
                <div class="alert alert-danger">{{ $errors->first('status') }}</div>
                @endif
                </div>

                <div class="form-group">
                  <label for="show_in_home">Show in Home:</label>
                  <label><input type="radio" name="show_in_home" value="1" @if($category->show_in_home=='1') checked @endif >Active</label>
                  <label><input type="radio" name="show_in_home" value="2" @if($category->show_in_home=='2') checked @endif >Inactive</label>
                  @if ($errors->has('show_in_home'))
                <div class="alert alert-danger">{{ $errors->first('show_in_home') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="banner_image">Image Upload</label>
                  <img src="{{ asset('frontend/images/categories-images/'.$category['banner_image']) }}" alt="Image" height="42" width="42">
                  <input type="file" class="form-control" name="banner_image" id="banner_image" value="{{$category->banner_image}}">
                  @if ($errors->has('banner_image'))
                <div class="alert alert-danger">{{$errors->first('banner_image') }}</div>
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