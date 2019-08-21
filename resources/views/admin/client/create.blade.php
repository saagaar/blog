@extends('layouts.common.main')
@section('content') 
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Clients</h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('client.list')}}"><span class="glyphicon glyphicon-minus"></span> All Clients</a></li>
                <li class="{{ (request()->is('create/client')) ? 'active' : '' }}"><a href="{{route('client.create')}}"><span class="glyphicon glyphicon-plus"></span> Create Client</a></li>
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
              <h3 class="box-title">Create Client</h3>
            </div>
          <!-- Form Element sizes -->
          <div class="box ">
            <div class="box-body">
            <form action="{{route('client.create')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                       <label for="title">Title</label>
                       <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" placeholder="Enter Title">
                       @if ($errors->has('title'))
                       <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                       @endif
                    </div>

                <div class="form-group">
                  <label for="url">URL</label>
                  <input type="text" class="form-control" name="url" id="url" placeholder="Enter URL" value="{{old('url')}}">
                  @if ($errors->has('url'))
                  <div class="alert alert-danger">{{ $errors->first('url') }}</div>
                  @endif
                </div>

              <div class="form-group">
                  <label for="logo">Image Upload</label>
                  <input type="file" class="form-control" name="logo" id="logo">
                  @if ($errors->has('logo'))
                  <div class="alert alert-danger">{{ $errors->first('logo') }}</div>
                  @endif
                </div>                
              </div>
              </div>                

               <div class="form-group">
                  <label for="status">Status</label>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="status" value="1" checked>
                        <label class="custom-control-label" for="defaultChecked">Yes</label>
                    </div>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="status" value="0" >
                        <label class="custom-control-label" for="defaultChecked">No</label>
                    </div>
                         @if ($errors->has('status'))
                         <div class="alert alert-danger">{{ $errors->first('status') }}</div>
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
      