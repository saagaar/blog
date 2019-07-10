@extends('layouts.common.main')
@section('content') 
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Help site
        <small>Create</small>
      </h1>
      @include('includes.breadcrumbs', ['breadcrumbs' => [
    'Dashboard' => route('admin.dashboard'),
    'Help Category' => route('helpcat.list'),
    'Create',
      ]])
    </section>
<?php 
// print_r($site);exit;
?>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Site Settings</h3>
            </div>
            <!-- Form Element sizes -->
            <div class="box">
            <div class="box-body">
            <form action="{{route('sitesetting.edit')}}" method="POST">
              @csrf
            <div class="box-body">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Website Settings</h3>
                </div>
                  <div class="box-body">
                    <div class="form-group col-md-4">
                        <label for="site_name">Site Name</label>
                        <input type="text" class="form-control" name="site_name" id="site_name" value="{{ $site->site_name}}" placeholder="Enter Help Category">
                        @if ($errors->has('site_name'))
                        <div class="alert alert-danger">{{ $errors->first('site_name') }}</div>
                        @endif
                        </div>
                         <div class="form-group col-md-4">
                          <label for="mode">mode: </label>
                          <label><input type="radio" name="mode" value="1" {{ $site->mode == '1' ? 'checked' : ''}}>live</label>
                          <label><input type="radio" name="mode" value="2"  {{ $site->mode == '2' ? 'checked' : ''}}>down</label>
                          <label><input type="radio" name="mode" value="3"  {{ $site->mode == '3' ? 'checked' : ''}}>Maintenance</label>
                          @if ($errors->has('mode'))
                        <div class="alert alert-danger">{{ $errors->first('mode') }}</div>
                        @endif
                        </div>
                        <div class="form-group  col-md-4">
                          <label for="user_activation">user_activation: </label>
                          <label><input type="radio" name="user_activation" value="1" {{ $site->user_activation == 'Y' ? 'checked' : ''}}>Yes</label>
                          <label><input type="radio" name="user_activation" value="2"  {{ $site->user_activation == 'N' ? 'checked' : ''}}>No</label>
                          @if ($errors->has('user_activation'))
                        <div class="alert alert-danger">{{ $errors->first('user_activation') }}</div>
                        @endif
                        </div>
                  </div>
                </div>
                 <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Site Logs</h3>
                  </div>
                  <div class="box-body">
                   <div class="form-group col-md-6">
                          <label for="log_admin_activity">log_admin_activity: </label>
                          <label><input type="radio" name="log_admin_activity" value="Y" {{ $site->log_admin_activity == 'Y' ? 'checked' : ''}}>Yes</label>
                          <label><input type="radio" name="log_admin_activity" value="N"  {{ $site->log_admin_activity == 'N' ? 'checked' : ''}}>No</label>
                          @if ($errors->has('log_admin_activity'))
                        <div class="alert alert-danger">{{ $errors->first('log_admin_activity') }}</div>
                        @endif
                        </div>
                        <div class="form-group col-md-6">
                          <label for="log_admin_invalid_login">log_admin_invalid_login: </label>
                          <label><input type="radio" name="log_admin_invalid_login" value="Y" {{ $site->log_admin_invalid_login == 'Y' ? 'checked' : ''}}>Yes</label>
                          <label><input type="radio" name="log_admin_invalid_login" value="N"  {{ $site->log_admin_invalid_login == 'N' ? 'checked' : ''}}>No</label>
                          @if ($errors->has('log_admin_invalid_login'))
                        <div class="alert alert-danger">{{ $errors->first('log_admin_invalid_login') }}</div>
                        @endif
                        </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group col-md-4">
                    <label for="contact_email">Contact Email</label>
                    <input type="text" class="form-control" name="contact_email" id="contact_email" value="{{ $site->contact_email}}" placeholder="Enter Help Category">
                    @if ($errors->has('contact_email'))
                  <div class="alert alert-danger">{{ $errors->first('contact_email') }}</div>
                  @endif
                  </div>
                  <div class="form-group col-md-4">
                    <label for="contact_name">Contact name</label>
                    <input type="text" class="form-control" name="contact_name" id="contact_name" value="{{ $site->contact_name}}" placeholder="Enter Help Category">
                    @if ($errors->has('contact_name'))
                  <div class="alert alert-danger">{{ $errors->first('contact_name') }}</div>
                  @endif
                  </div>
                  <div class="form-group col-md-4">
                    <label for="contact_number">Contact number</label>
                    <input type="text" class="form-control" name="contact_number" id="contact_number" value="{{ $site->contact_number}}" placeholder="Enter Help Category">
                    @if ($errors->has('contact_number'))
                  <div class="alert alert-danger">{{ $errors->first('contact_number') }}</div>
                  @endif
                  </div>
                </div>
                <br>
                <div class="col-md-12">
                   <div class="form-group col-md-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address" value="{{ $site->address}}" placeholder="Enter Help Category">
                    @if ($errors->has('address'))
                  <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                  @endif
                  </div>
                   <div class="form-group col-md-3">
                    <label for="city">city</label>
                    <input type="text" class="form-control" name="city" id="city" value="{{ $site->city}}" placeholder="Enter Help Category">
                    @if ($errors->has('city'))
                  <div class="alert alert-danger">{{ $errors->first('city') }}</div>
                  @endif
                  </div>
                   <div class="form-group col-md-3">
                    <label for="state">state</label>
                    <input type="text" class="form-control" name="state" id="state" value="{{ $site->state}}" placeholder="Enter Help Category">
                    @if ($errors->has('state'))
                  <div class="alert alert-danger">{{ $errors->first('state') }}</div>
                  @endif
                  </div>
                   <div class="form-group col-md-3">
                    <label for="country">country</label>
                    <input type="text" class="form-control" name="country" id="country" value="{{ $site->country}}" placeholder="Enter Help Category">
                    @if ($errors->has('country'))
                  <div class="alert alert-danger">{{ $errors->first('country') }}</div>
                  @endif
                  </div>
                </div>
                <div class=" col-md-12">
                  <div class="form-group col-md-12">
                  <label for="maintainence">Maintainence</label>
                  <input type="text" class="form-control" name="maintainence" id="maintainence" value="{{ $site->maintainence}}" placeholder="Enter Help Category">
                  @if ($errors->has('maintainence'))
                  <div class="alert alert-danger">{{ $errors->first('maintainence') }}</div>
                  @endif
                  </div>
                </div>
                
                <div class="col-md-12">
                  <div class="form-group col-md-3">
                  <label for="facebook_id">facebook_id</label>
                  <input type="text" class="form-control" name="facebook_id" id="facebook_id" value="{{ $site->facebook_id}}" placeholder="Enter Help Category">
                  @if ($errors->has('facebook_id'))
                  <div class="alert alert-danger">{{ $errors->first('facebook_id') }}</div>
                  @endif
                  </div>
                  <div class="form-group col-md-3">
                    <label for="linkedin_id">linkedin_id</label>
                    <input type="text" class="form-control" name="linkedin_id" id="linkedin_id" value="{{ $site->linkedin_id}}" placeholder="Enter Help Category">
                    @if ($errors->has('linkedin_id'))
                  <div class="alert alert-danger">{{ $errors->first('linkedin_id') }}</div>
                  @endif
                  </div>
                <div class="form-group col-md-3">
                    <label for="twitter_id">twitter_id</label>
                    <input type="text" class="form-control" name="twitter_id" id="twitter_id" value="{{ $site->twitter_id}}" placeholder="Enter Help Category">
                    @if ($errors->has('twitter_id'))
                  <div class="alert alert-danger">{{ $errors->first('twitter_id') }}</div>
                  @endif
                  </div>
                <div class="form-group col-md-3">
                    <label for="instagram_id">instagram_id</label>
                    <input type="text" class="form-control" name="instagram_id" id="instagram_id" value="{{ $site->instagram_id}}" placeholder="Enter Help Category">
                    @if ($errors->has('instagram_id'))
                  <div class="alert alert-danger">{{ $errors->first('instagram_id') }}</div>
                  @endif
                  </div>
                   <div class="form-group col-md-3">
                  <label for="youtube">youtube</label>
                  <input type="text" class="form-control" name="youtube" id="youtube" value="{{ $site->youtube}}" placeholder="Enter Help Category">
                  @if ($errors->has('youtube'))
                <div class="alert alert-danger">{{ $errors->first('youtube') }}</div>
                @endif
                </div>
                </div>
                
                <div class="col-md-12">
                  <div class="form-group col-md-12">
                  <label for="timezone">timezone</label>
                  <input type="text" class="form-control" name="timezone" id="timezone" value="{{ $site->timezone}}" placeholder="Enter Help Category">
                  @if ($errors->has('timezone'))
                <div class="alert alert-danger">{{ $errors->first('timezone') }}</div>
                @endif
                </div>
                <div class="form-group col-md-12">
                  <label for="currency_sign">currency_sign</label>
                  <input type="text" class="form-control" name="currency_sign" id="currency_sign" value="{{ $site->currency_sign}}" placeholder="Enter Help Category">
                  @if ($errors->has('currency_sign'))
                <div class="alert alert-danger">{{ $errors->first('currency_sign') }}</div>
                @endif
                </div>
                 <div class="form-group col-md-12">
                  <label for="currency_code">currency_code</label>
                  <input type="text" class="form-control" name="currency_code" id="currency_code" value="{{ $site->currency_code}}" placeholder="Enter Help Category">
                  @if ($errors->has('currency_code'))
                <div class="alert alert-danger">{{ $errors->first('currency_code') }}</div>
                @endif
                </div>
                <div class="form-group col-md-12">
                  <label for="google_analytics_code">google_analytics_code</label>
                  <input type="text" class="form-control" name="google_analytics_code" id="google_analytics_code" value="{{ $site->google_analytics_code}}" placeholder="Enter Help Category">
                  @if ($errors->has('google_analytics_code'))
                <div class="alert alert-danger">{{ $errors->first('google_analytics_code') }}</div>
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
  </div>
          @endsection