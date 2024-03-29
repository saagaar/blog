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
                  <input type="text" class="form-control" name="name" id="name" value="{{old('name',$category->name)}}" placeholder="Enter Help Category">
                  @if ($errors->has('name'))
                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                @endif
                </div>
                  <div class="form-group">
                  <label for="description">Meta Description: </label>
                    <textarea name="description" class="form-control" rows="5" placeholder="Enter Description here..">{{ old('description',$category->description) }}</textarea>

                  @if ($errors->has('description'))
                  <div class="alert alert-danger">{{ $errors->first('description') }}</div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="parent_id">Parent</label>
                    <select class="form-control"  name="parent_id" id="parent_id">
                      <option value="">none</option>
                      @foreach ($blogcategory as $values)
                      
                      <option value="{{ old('parent_id',$values->id) }}" @if($values->id==$category->parent_id) selected @endif > {{ $values->name }}  </option>
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
                  <input type="text" class="form-control" name="slug" id="slug" value="{{old('slug',$category->slug)}}" placeholder="Enter Help Category">
                  @if ($errors->has('slug'))
                <div class="alert alert-danger">{{ $errors->first('slug') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="tags">Tags</label>
                    <select multiple="multiple" class="form-control js-example-basic-multiple"  name="tags[]" id="tags">

                      @if(!($category->tags()->pluck('tags_id'))->isEmpty())
                        @foreach ($tags as $values)
                          @foreach($category->tags()->pluck('tags_id') as $tagsid)

                            <option value="{{ $values->id }}" @if($values->id == $tagsid) selected @endif> {{ $values->name }}  </option>
                          @endforeach
                        @endforeach
                      @else
                        @foreach ($tags as $values)
                         <option value="{{ $values->id }}">{{ $values->name }}</option>
                         @endforeach
                      @endif
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
                  <input type="number" class="form-control" name="priority" id="priority" placeholder="Priority" value="{{old('priority',$category->priority)}}">
                  @if ($errors->has('priority'))
                  <div class="alert alert-danger">{{ $errors->first('priority') }}</div>
                  @endif
                </div>

                <div class="form-group">
                  <label for="status">Display:</label>
                  <label><input type="radio" name="status" value="1" @if(old('status',$category->status)=='1') checked @endif >Active</label>
                  <label><input type="radio" name="status" value="2" @if(old('status',$category->status)=='2') checked @endif >Inactive</label>
                  @if ($errors->has('status'))
                <div class="alert alert-danger">{{ $errors->first('status') }}</div>
                @endif
                </div>
             
                <div class="form-group">
                  <label for="show_in_home">Show in Home:</label>
                  <label><input type="radio" name="show_in_home" value="1" @if(old('show_in_home',$category->show_in_home)=='1') checked @endif >Active</label>
                  <label><input type="radio" name="show_in_home" value="2" @if(old('show_in_home',$category->show_in_home)=='2') checked @endif >Inactive</label>
                  @if ($errors->has('show_in_home'))
                <div class="alert alert-danger">{{ $errors->first('show_in_home') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="banner_image">Image Upload</label>
                  <input type="file" class="form-control" name="banner_image" id="banner_image" value="{{$category->banner_image}}">
                   <img src="{{ asset('uploads/categories-images/'.$category['banner_image']) }}" alt="Image" height="60" width="60">
                  @if ($errors->has('banner_image'))
                <div class="alert alert-danger">{{$errors->first('banner_image') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="meta_keyword">Meta Keyword</label>
                  <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" value="{{ old('meta_keyword',$category->meta_keyword) }}" placeholder="Enter Meta Key" >
                  @if ($errors->has('meta_keyword'))
                  <div class="alert alert-danger">{{ $errors->first('meta_keyword') }}</div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="meta_title">Meta title</label>
                  <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ old('meta_title',$category->meta_title) }}" placeholder="Enter Meta Title">
                  @if ($errors->has('meta_title'))
                  <div class="alert alert-danger">{{ $errors->first('meta_title') }}</div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="meta_description">Meta Description: </label>
                    <textarea name="meta_description" class="form-control" rows="5" placeholder="Meta Description here..">{{ old('meta_description',$category->meta_description) }}</textarea>
                  @if ($errors->has('meta_description'))
                  <div class="alert alert-danger">{{ $errors->first('meta_description') }}</div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="schema1">schema1</label>
                  <textarea name="schema1" class="form-control" rows="8" placeholder="Schema1 here..">{{ old('schema1',$category->schema1)}}</textarea>
                                      
                  @if ($errors->has('schema1'))
                  <div class="alert alert-danger">{{ $errors->first('schema1') }}</div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="schema2">schema2</label>
                  <textarea name="schema2" class="form-control" rows="8" placeholder="Schema2 here..">{{old('schema2',$category->schema2)}}</textarea>                 
                  @if ($errors->has('schema2'))
                  <div class="alert alert-danger">{{ $errors->first('schema2') }}</div>
                  @endif
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
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