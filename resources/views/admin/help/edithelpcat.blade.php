@extends('layouts.common.main')
@section('content') 
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Help Category</h3>

              <!-- <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div> -->
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('helpcat.list')}}"><span class="glyphicon glyphicon-minus"></span> List All Help Category</a></li>
                <li class="{{ (request()->is('/create/helpcategory')) ? 'active' : '' }}"><a href="{{route('helpcat.create')}}"><span class="glyphicon glyphicon-minus"></span> Create Help Category</a></li>
                
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
              <h3 class="box-title">Edit Help Category</h3>
            </div>

          <!-- Form Element sizes -->
          <div class="box box-success">
            <div class="box-body">
            <form action="{{ route('helpcat.edit' , $category->id) }}" method="POST">
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
                  <label for="Display">Display: </label>
                  <label><input type="radio" name="display" value="1" {{ $category->display == '1' ? 'checked' : ''}}>Active</label>
                  <label><input type="radio" name="display" value="0"  {{ $category->display == '0' ? 'checked' : ''}}>Inactive</label>
                  @if ($errors->has('display'))
                <div class="alert alert-danger">{{ $errors->first('display') }}</div>
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