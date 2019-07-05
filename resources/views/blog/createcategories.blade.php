@extends('layouts.common.main')
@section('content') 
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        blog Category
        <small>Create</small>
      </h1>
      @include('includes.breadcrumbs', ['breadcrumbs' => [
    'Dashboard' => route('admin.dashboard'),
    'blog Category' => route('adminblogcategory.list'),
    'Create',
      ]])
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">blog Category</h3>

              <!-- <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div> -->
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('adminblogcategory.list')}}"><span class="glyphicon glyphicon-minus"></span> List All blog Category</a></li>
                <li class="{{ (request()->is('create/blogcategory')) ? 'active' : '' }}"><a href="{{route('adminblogcategory.create')}}"><span class="glyphicon glyphicon-minus"></span> Create blog Category</a></li>
                
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
              <h3 class="box-title">Create blog Category</h3>
            </div>
          <!-- Form Element sizes -->
          <div class="box box-success">
            <div class="box-body">
            <form action="{{route('adminblogcategory.create')}}" method="POST">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Enter blog Category">
                  @if ($errors->has('name'))
                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
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
                  <label for="Display">Display: </label>
                  <label><input type="radio" name="display" value="Y">Yes</label>
                  <label><input type="radio" name="display" value="N">No</label>
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
  </div>
          @endsection