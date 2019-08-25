@extends('layouts.common.main')
@section('content') 
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Cms</h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('cms.list')}}"><span class="glyphicon glyphicon-minus"></span> All CMS</a></li>
                <li class="{{ (request()->is('create/cms')) ? 'active' : '' }}"><a href="{{route('cms.create')}}"><span class="glyphicon glyphicon-plus"></span> Create CMS</a></li>
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
              <h3 class="box-title">Create CMS</h3>
            </div>
          <!-- Form Element sizes -->
          <div class="box ">
            <div class="box-body">
            <form action="{{route('cms.create')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                       <label for="heading">Heading</label>
                       <input type="text" class="form-control" name="heading" id="heading" value="{{ old('title') }}" placeholder="Enter Heading">
                       @if ($errors->has('heading'))
                       <div class="alert alert-danger">{{ $errors->first('heading') }}</div>
                       @endif
                    </div>
                <div class="form-group">
                  <label for="cms_slug">CMS Slug</label>
                  <input type="text" class="form-control" name="cms_slug" id="cms_slug" placeholder="Enter Cms Slug">
                  @if ($errors->has('cms_slug'))
                  <div class="alert alert-danger">{{ $errors->first('cms_slug') }}</div>
                  @endif
                </div>
                 <div class="form-group">
                  <label for="status">Is Display</label>
                  <div class="custom-control custom-radio radio-inline">
                    <input type="radio" class="custom-control-input flat-red" name="status"  value="1" checked>
                    <label class="custom-control-label" for="defaultChecked">Yes</label>
                  </div>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="status"  value="0" >
                        <label class="custom-control-label" for="defaultChecked">No</label>
                    </div>
                        @if ($errors->has('status'))
                        <div class="alert alert-danger">{{ $errors->first('status') }}</div>
                         @endif
                      </div>
                  <div class="form-group">
                  <label for="cms_type">Cms Type</label>
                  <div class="custom-control custom-radio radio-inline">
                    <input type="radio" class="custom-control-input flat-red" name="cms_type"  value="1" checked>
                    <label class="custom-control-label" for="defaultChecked">Website</label>
                  </div>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="cms_type"  value="0" >
                        <label class="custom-control-label" for="defaultChecked">System</label>
                    </div>
                        @if ($errors->has('cms_type'))
                        <div class="alert alert-danger">{{ $errors->first('cms_type') }}</div>
                         @endif
                      </div>
                </div>
              </div>                
                <div class="row"> 
                  <div class="form-group">
                    <label for="Content">Content: </label>
                    <textarea name="content" class="form-control" id="content" placeholder="CMS Content here..">{{old('content')}}</textarea>
                    @if ($errors->has('content'))
                    <div class="alert alert-danger">{{ $errors->first('content') }}</div>
                    @endif
                  </div>  
                 </div>

              <div class="row">
                <div class="form-group">
                  <label for="page_title">Page Title</label>
                     <textarea name="page_title" class="form-control" rows="5" placeholder="Page title here..">{{old('page_title')}}</textarea>
                       
                  @if ($errors->has('page_title'))
                  <div class="alert alert-danger">{{ $errors->first('page_title') }}</div>
                  @endif
                </div>
              
                <div class="form-group">
                  <label for="meta_key">Meta Keywords</label>
                   <textarea name="meta_key" class="form-control" rows="5" placeholder="Meta Keywords here..">{{old('meta_key')}}</textarea>              
                  @if ($errors->has('meta_key'))
                  <div class="alert alert-danger">{{ $errors->first('meta_key') }}</div>
                  @endif
                </div>

               <div class="form-group">
                  <label for="meta_description">Meta Description</label>
                  <textarea name="meta_description" class="form-control" rows="5" placeholder="Meta Description here..">{{old('meta_description')}}</textarea>           @if ($errors->has('meta_description'))
                  <div class="alert alert-danger">{{ $errors->first('meta_description') }}</div>
                  @endif
                </div>

                <div class="form-group">
                  <label for="deletable">Is Deletable</label>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="deletable"  value="Y" checked>
                        <label class="custom-control-label" for="defaultChecked">Yes</label>
                    </div>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="deletable" value="N" >
                        <label class="custom-control-label" for="defaultChecked">No</label>
                      </div>
                       @if ($errors->has('deletable'))
                       <div class="alert alert-danger">{{ $errors->first('deletable') }}</div>
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
      