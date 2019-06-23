@extends('layouts.common.main')
@section('content') 
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Help
        <small>Create</small>
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
              <h3 class="box-title">Create Help</h3>
            </div>


          <!-- Form Element sizes -->
          <div class="box box-success">
            <div class="box-body">
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" placeholder="Enter Help Title">
                </div>
                <div class="form-group">
                  <label for="Display">Display: </label>
                  <label><input type="radio" name="status" value="0">Yes</label>
                  <label><input type="radio" name="status" value="1">No</label>
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