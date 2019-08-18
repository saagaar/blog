@extends('layouts.common.main')
@section('content') 
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Payment Gateways</h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('paymentgateway.list')}}"><span class="glyphicon glyphicon-minus"></span> All Payment Gateways</a></li>
                <li class="{{ (request()->is('create/paymentgateway')) ? 'active' : '' }}"><a href="{{route('paymentgateway.create')}}"><span class="glyphicon glyphicon-plus"></span> Create Payment Gateways</a></li>
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
              <h3 class="box-title">Create Payment Gateways</h3>
            </div>
          <!-- Form Element sizes -->
          <div class="box ">
            <div class="box-body">
            <form action="{{route('paymentgateway.create')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                       <label for="email">Email</label>
                       <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Enter Your Email">
                       @if ($errors->has('email'))
                       <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                       @endif
                    </div>

                <div class="form-group">
                  <label for="mode">Payment Mode</label>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="mode" value="Y" checked>
                        <label class="custom-control-label" for="defaultChecked">Live</label>
                    </div>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="mode" value="N" >
                        <label class="custom-control-label" for="defaultChecked">Test</label>
                    </div>
                         @if ($errors->has('mode'))
                         <div class="alert alert-danger">{{ $errors->first('mode') }}</div>
                         @endif
                  </div>

                <div class="form-group">
                  <label for="image">Image Upload</label>
                  <input type="file" class="form-control" name="image" id="image" required>  
                  @if ($errors->has('image'))
                  <div class="alert alert-danger">{{ $errors->first('image') }}</div>
                  @endif
                </div>       
              </div>
              </div>  

               <div class="form-group">
                       <label for="api_merchant_key">API Merchant Key</label>
                       <input type="text" class="form-control" name="api_merchant_key" id="api_merchant_key" value="{{ old('api_merchant_key') }}" placeholder="Enter API Merchant Key">
                       @if ($errors->has('api_merchant_key'))
                       <div class="alert alert-danger">{{ $errors->first('api_merchant_key') }}</div>
                       @endif
                    </div>

                     <div class="form-group">
                       <label for="api_merchant_password">API Merchant Password</label>
                       <input type="password" class="form-control" name="api_merchant_password" id="api_merchant_password" value="{{ old('api_merchant_password') }}" placeholder="Enter API Merchant Password">
                       @if ($errors->has('api_merchant_password'))
                       <div class="alert alert-danger">{{ $errors->first('api_merchant_password') }}</div>
                       @endif
                    </div>

                     <div class="form-group">
                       <label for="api_merchant_signature">API Merchant Signature</label>
                       <input type="text" class="form-control" name="api_merchant_signature" id="api_merchant_signature" value="{{ old('api_merchant_signature') }}" placeholder="Enter API Merchant signature">
                       @if ($errors->has('api_merchant_signature'))
                       <div class="alert alert-danger">{{ $errors->first('api_merchant_signature')}}</div>
                       @endif
                    </div>
                  
                  <div class="form-group">
                       <label for="api_version">API Merchant Version*</label>
                       <input type="text" class="form-control" name="api_version" id="api_version" value="{{ old('api_version') }}" placeholder="Enter API Merchant Version">
                       @if ($errors->has('api_version'))
                       <div class="alert alert-danger">{{ $errors->first('api_version')}}</div>
                       @endif
                    </div>

               <div class="form-group">
                  <label for="status">Status</label>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="status" value="Y" checked>
                        <label class="custom-control-label" for="defaultChecked">Yes</label>
                    </div>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="status" value="N" >
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
      