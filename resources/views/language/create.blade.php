@extends('layouts.common.main')
@section('content') 
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-3">
          <div class="box box-solid box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Languages</h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('language.list')}}"><span class="glyphicon glyphicon-minus"></span> All language list</a></li>
                <li class="{{ (request()->is('create/language')) ? 'active' : '' }}"><a href="{{route('language.create')}}"><span class="glyphicon glyphicon-plus"></span> Create language</a></li>
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
              <h3 class="box-title">Create language</h3>
            </div>
          <!-- Form Element sizes -->
        <div class="box ">
          <div class="box-body">
            <form action="{{route('language.create')}}" method="POST" enctype="multipart/form-data"> 
              @csrf            
              <div class="box-body">
                <div class="form-group">
                  <label for="short_code">Short Code</label>
                  <input type="text" class="form-control" name="short_code" id="Short Code" value="{{ old('short_code') }}" placeholder="Enter short_code">
                  @if ($errors->has('short_code'))
                  <div class="alert alert-danger">{{ $errors->first('short_code') }}</div>
                  @endif
                </div>

                 <div class="form-group">
                  <label for="lang_name">Language</label>
                  <input type="text" class="form-control" name="lang_name" id="Language" value="{{ old('lang_name') }}" placeholder="Enter lang_name">
                  @if ($errors->has('lang_name'))
                  <div class="alert alert-danger">{{ $errors->first('lang_name') }}</div>
                   @endif
                 </div>

                  <div class="form-group">
                  <label for="currency_code">Currency Code</label>
                  <input type="text" class="form-control" name="currency_code" id="currency_code" value="{{ old('currency_code') }}" placeholder="Enter Currency Code">
                  @if ($errors->has('currency_code'))
                  <div class="alert alert-danger">{{ $errors->first('currency_code') }}</div>
                   @endif
                 </div> 

                  <div class="form-group">
                  <label for="currency_sign">Currency Sign</label>
                 <input type="text" class="form-control" name="currency_sign" id="currency_sign" value="{{ old('currency_sign') }}" placeholder="Enter Currency Sign">
                  @if ($errors->has('currency_sign'))
                  <div class="alert alert-danger">{{ $errors->first('currency_sign') }}</div>
                   @endif
                 </div> 

                <div class="form-group">
                  <label for="priority">Priority</label>
                  <input type="number" class="form-control" name="priority" id="Priority" placeholder="Priority Order" value="{{old('priority')}}">
                  @if ($errors->has('priority'))
                  <div class="alert alert-danger">{{ $errors->first('priority') }}</div>
                  @endif
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
      