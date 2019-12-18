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
                <li class="{{ (request()->is('create/blog')) ? 'active' : '' }}"><a href="{{route('blog.create')}}"><span class="glyphicon glyphicon-plus"></span>Create Blog</a></li>
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
            <form action="{{route('blog.create')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="box-body">  
                <div class="form-group">
                  <label for="name">Title</label>
                  <input type="text" class="form-control" name="title" id="name" value="{{ old('title') }}" placeholder="Enter Title">
                  @if ($errors->has('title'))
                <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="language">Language</label>
                  <select class="form-control" name="locale_id">
                    @if(!empty($localeList))
                      @foreach($localeList as $eachLocale)
                      <option value="{{$eachLocale['id']}}">{{$eachLocale['lang_name']}}
                      </option>
                      @endforeach
                    @endif
                  </select>
                  @if ($errors->has('locale_id')) 
                <div class="alert alert-danger">{{ $errors->first('locale_id') }}</div>
                @endif
                </div>
                               
                <div class="form-group">
                  <label for="Content">Content:</label>
                    <textarea name="content" class="form-control" id="contenteditor" placeholder="Blog Content here..">{{ old('content') }}</textarea>
                  @if ($errors->has('content'))
                  <div class="alert alert-danger">{{  $errors->first('content')}}
                 </div>
                  @endif
                 </div>
                <div class="form-group">
                  <label for="short_description">Short Description: </label>
                    <textarea name="short_description" class="form-control" rows="5" placeholder="Short Description here..">{{ old('short_description')}}
                    </textarea> 
                  @if ($errors->has('short_description'))
                  <div class="alert alert-danger">{{ $errors->first('short_description') }}
                  </div>
                  @endif
                </div>
                 <div class="form-group">
                  <label for="image">Image Upload</label>
                  <input type="file" class="form-control" name="image" id="image">
                  @if ($errors->has('image'))
                  <div class="alert alert-danger">{{ $errors->first('image') }}</div>
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
                       <div class="alert alert-danger"> 
                            {{ $errors->first('tags') }}
                        </div>
                    @endif
                </div>
                <div class="col-md-12">
                  <div class="form-group col-md-4">
                  <label for="Save Method">Save Method: </label>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input flat-red" name="save_method"  value="1" checked>
                        <label class="custom-control-label" for="defaultChecked">Save</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input flat-red" name="save_method"  value="2" >
                        <label class="custom-control-label" for="defaultChecked">Publish</label>
                      </div>
                  @if ($errors->has('save_method'))
                <div class="alert alert-danger">{{ $errors->first('save_methods') }}</div>
                @endif
                </div>                
             <div class="form-group col-md-4">
              <label for="show_in_home">Show in Home:</label>
               <div class="custom-control custom-radio">
                 <input type="radio" class="custom-control-input flat-red" name="show_in_home" value="1" checked>
                 <label class="custom-control-label" for="defaultChecked">Active</label>
               </div>
             <div class="custom-control custom-radio">
               <input type="radio" class="custom-control-input flat-red" name="show_in_home"  value="2">
              <label class="custom-control-label" for="defaultChecked">Inactive</label>
             </div>
              @if ($errors->has('show_in_home'))
              <div class="alert alert-danger">{{ $errors->first('show_in_home') }}</div>
              @endif
          </div>
                 <div class="form-group col-md-4">
                  <label for="featured">Featured: </label>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input flat-red" name="featured"  value="2" checked>
                        <label class="custom-control-label" for="defaultChecked">No</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input flat-red" name="featured"  value="1" >
                        <label class="custom-control-label" for="defaultChecked">Yes</label>
                    
                      </div>
                  @if ($errors->has('featured'))
                <div class="alert alert-danger">{{ $errors->first('featured') }}</div>
                @endif
                </div>
                 <div class="form-group col-md-4">
                  <label for="anynomous">Be Anynomous: </label>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input flat-red" name="anynomous"  value="2" checked>
                        <label class="custom-control-label" for="defaultChecked">No</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input flat-red" name="anynomous"  value="1" >
                        <label class="custom-control-label" for="defaultChecked">Yes</label>
                      </div>
                  @if ($errors->has('anynomous'))
                <div class="alert alert-danger">{{ $errors->first('anynomous') }}</div>
                @endif
                </div>

                 <div class="form-group col-md-4">
                  <label for="type">Type</label>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input flat-red" name="type"  value="1" checked>
                        <label class="custom-control-label" for="defaultChecked">Private</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input flat-red" name="type"  value="2" >
                        <label class="custom-control-label" for="defaultChecked">Public</label>
                      </div>
                  @if ($errors->has('type'))
                <div class="alert alert-danger">{{ $errors->first('type') }}</div>
                @endif
                </div>
               
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
      