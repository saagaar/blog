@extends('layouts.common.main')
@section('content') 
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Help Category
        <small>Edit Category</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-1">
      </div>
        <!-- left column -->
        <div class="col-md-10">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Help Category</h3>
            </div>

            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
@endif
          <!-- Form Element sizes -->
          <div class="box box-success">
            <div class="box-body">
            <form action="{{action('HelpCategoryController@update',$category->id) }}" method="POST">
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
                  <label><input type="radio" name="display" value="Y" {{ $category->display == 'Y' ? 'checked' : ''}}>Yes</label>
                  <label><input type="radio" name="display" value="N"  {{ $category->display == 'N' ? 'checked' : ''}}>No</label>
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
      <div class="col-md-1">
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
          @endsection