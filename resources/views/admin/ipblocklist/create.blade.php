@extends('layouts.common.main')
@section('content') 
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">blocklist</h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('blocklist.list')}}"><span class="glyphicon glyphicon-minus"></span> All blocklist</a></li>
                <li class="{{ (request()->is('create/blocklist')) ? 'active' : '' }}"><a href="{{route('blocklist.create')}}"><span class="glyphicon glyphicon-plus"></span> Create blocklist</a></li>
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
              <h3 class="box-title">Create Blocklist</h3>
            </div>
          <!-- Form Element sizes -->
          <div class="box ">
            <div class="box-body">
            <form action="{{route('blocklist.create')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                       <label for="ip_address">Ip Address</label>
                       <input type="text" class="form-control" name="ip_address" id="ip_address" value="{{ old('ip_address') }}" placeholder="Enter IP address">
                       @if ($errors->has('ip_address'))
                       <div class="alert alert-danger">{{ $errors->first('ip_address') }}</div>
                       @endif
                    </div>
                    <div class="form-group">
                       <label for="message">Message</label>
                       <input type="hidden" name="admin_id" id="admin_id" value="{{ $adminId }}">
                       <input type="text" class="form-control" name="message" id="message" value="{{ old('message') }}" placeholder="Enter message">
                       @if ($errors->has('message'))
                       <div class="alert alert-danger">{{ $errors->first('message') }}</div>
                       @endif
                    </div>
                 <div class="form-group">
                  <label for="status">Status</label>
                  <div class="custom-control custom-radio radio-inline">
                    <input type="radio" class="custom-control-input flat-red" name="status"  value="black" checked>
                    <label class="custom-control-label" for="defaultChecked">black</label>
                  </div>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="status"  value="white" >
                        <label class="custom-control-label" for="defaultChecked">white</label>
                    </div>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="status"  value="grey" >
                        <label class="custom-control-label" for="defaultChecked">grey</label>
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
      