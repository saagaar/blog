@extends('layouts.common.main')
@section('content') 

  <section class="content">
  <form action="{{route('sitesetting')}}" method="POST">
              @csrf
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Basic Settings
                <small>All basic default settings</small>
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
               <!--  <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button> -->
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
                      <div class="form-group col-md-4">
                        <label for="site_name">Site Name</label>
                        <input type="text" class="form-control" name="site_name" id="site_name" value="{{ $site->site_name}}" placeholder="Site Name">
                        @if ($errors->has('site_name'))
                        <div class="alert alert-danger">{{ $errors->first('site_name') }}</div>
                        @endif
                      </div>
                  <div class="form-group col-md-4">
                    <label for="contact_email">Contact Email</label>
                    <input type="text" class="form-control" name="contact_email" id="contact_email" value="{{ $site->contact_email}}" placeholder="Contact Email">
                    @if ($errors->has('contact_email'))
                  <div class="alert alert-danger">{{ $errors->first('contact_email') }}</div>
                  @endif
                  </div>
                  <div class="form-group col-md-4">
                    <label for="contact_name">Contact name</label>
                    <input type="text" class="form-control" name="contact_name" id="contact_name" value="{{ $site->contact_name}}" placeholder="Contact Name">
                    @if ($errors->has('contact_name'))
                  <div class="alert alert-danger">{{ $errors->first('contact_name') }}</div>
                  @endif
                  </div>
                  <div class="form-group col-md-4">
                    <label for="contact_number">Contact number</label>
                    <input type="text" class="form-control" name="contact_number" id="contact_number" value="{{ $site->contact_number}}" placeholder="Contact Number">
                    @if ($errors->has('contact_number'))
                  <div class="alert alert-danger">{{ $errors->first('contact_number') }}</div>
                  @endif
                  </div>
                   <div class="form-group col-md-4">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address" value="{{ $site->address}}" placeholder="Enter Address">
                    @if ($errors->has('address'))
                  <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                  @endif
                  </div>
                   <div class="form-group col-md-4">
                    <label for="city">City</label>
                    <input type="text" class="form-control" name="city" id="city" value="{{ $site->city}}" placeholder="Enter City">
                    @if ($errors->has('city'))
                  <div class="alert alert-danger">{{ $errors->first('city') }}</div>
                  @endif
                  </div>
                   <div class="form-group col-md-4">
                    <label for="state">State</label>
                    <input type="text" class="form-control" name="state" id="state" value="{{ $site->state}}" placeholder="Enter State">
                    @if ($errors->has('state'))
                  <div class="alert alert-danger">{{ $errors->first('state') }}</div>
                  @endif
                  </div>
                   <div class="form-group col-md-4">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" name="country" id="country" value="{{ $site->country}}" placeholder="Select Country">
                    @if ($errors->has('country'))
                  <div class="alert alert-danger">{{ $errors->first('country') }}</div>
                  @endif
                  </div>
                  <div class="form-group col-md-4">
                      <br><br>
                          <label for="user_activation">User Activation: </label>
                            <input type="radio"  class="flat-red user_activation" name="user_activation"  value="Y" {{ $site->user_activation == 'Y' ? 'checked' : ''}}>Yes 
                          <label><input type="radio" class="flat-red"  name="user_activation" value="N"  {{ $site->user_activation == 'N' ? 'checked' : ''}}>No</label>
                          @if ($errors->has('user_activation'))
                        <div class="alert alert-danger">{{ $errors->first('user_activation') }}</div>
                        @endif
                     </div> 
                      <div class="form-group col-md-4">
                          <label for="mode">Mode: </label>
                          <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input flat-red" name="mode"  value="1" {{ $site->mode == '1' ? 'checked' : ''}}>
                          <label class="custom-control-label" for="defaultChecked">Live</label>
                          </div>
                          <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input flat-red" name="mode"  value="2" {{ $site->mode == '2' ? 'checked' : ''}}>
                          <label class="custom-control-label" for="defaultChecked">Down</label>
                          </div>
                          <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input flat-red" name="mode"  value="3" {{ $site->mode == '3' ? 'checked' : ''}}>
                          <label class="custom-control-label" for="defaultChecked">Maintenance</label>
                          </div>
                         
                          @if ($errors->has('mode'))
                          <div class="alert alert-danger">{{ $errors->first('mode') }}</div>
                        @endif
                        </div>
                        <div class="form-group col-md-4">
                      <label for="maintainence">Maintainence</label>
                      <input type="text" class="form-control" name="maintainence" id="maintainence" value="{{ $site->maintainence}}" placeholder="Enter Google Analytics">
                      @if ($errors->has('maintainence'))
                    <div class="alert alert-danger">{{ $errors->first('maintainence') }}</div>
                    @endif
                    </div>   

            </div>

          </div>
          <!-- /.box -->

          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">General Settings
                <small></small>
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
               <!--  <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button> -->
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
                <div class="box-body pad">


                     <div class="form-group col-md-4">
                          <label class="log_admin_activity">Log Admin Activity: </label>
                            <input type="radio"  class="flat-red log_admin_activity" name="log_admin_activity"  value="Y" {{ $site->log_admin_activity == 'Y' ? 'checked' : ''}}>Yes 
                          <label><input type="radio" class="flat-red"  name="log_admin_activity" value="N"  {{ $site->log_admin_activity == 'N' ? 'checked' : ''}}>No</label>
                          @if ($errors->has('log_admin_activity'))
                        <div class="alert alert-danger">{{ $errors->first('log_admin_activity') }}</div>
                        @endif
                     </div>
                     <div class="form-group col-md-4">
                          <label for="log_admin_invalid_login">Log Admin Invalid Login: </label>
                          <label><input type="radio" class="flat-red" name="log_admin_invalid_login" value="Y" {{ $site->log_admin_invalid_login == 'Y' ? 'checked' : ''}}>Yes</label>
                          <label><input type="radio" class="flat-red" name="log_admin_invalid_login" value="N"  {{ $site->log_admin_invalid_login == 'N' ? 'checked' : ''}}>No</label>
                          @if ($errors->has('log_admin_invalid_login'))
                        <div class="alert alert-danger">{{ $errors->first('log_admin_invalid_login') }}</div>
                        @endif
                    </div>
                      <div class="form-group col-md-4">
                          <label for="log_admin_invalid_login">Approve Post: </label>
                          <label><input type="radio" class="flat-red" name="approve_post" value="Y" {{ $site->log_admin_invalid_login == 'Y' ? 'checked' : ''}}>Yes</label>
                          <label><input type="radio" class="flat-red" name="approve_post" value="N"  {{ $site->log_admin_invalid_login == 'N' ? 'checked' : ''}}>No</label>
                          @if ($errors->has('log_admin_invalid_login'))
                        <div class="alert alert-danger">{{ $errors->first('log_admin_invalid_login') }}</div>
                        @endif
                    </div>
               </div>
          </div>

          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Timezone/Region Settings
                <small></small>
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
               <!--  <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button> -->
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
                <div class="box-body pad">
                   <div class="form-group col-md-4">
                    <label for="timezone">Timezone</label>
                    <input type="text" class="form-control" name="timezone" id="timezone" value="{{ $site->timezone}}" placeholder="Enter Help Category">
                    @if ($errors->has('timezone'))
                  <div class="alert alert-danger">{{ $errors->first('timezone') }}</div>
                  @endif
                 </div>
                  <div class="form-group col-md-4">
                  <label for="currency_sign">Currency Sign</label>
                  <input type="text" class="form-control" name="currency_sign" id="currency_sign" value="{{ $site->currency_sign}}" placeholder="Enter Help Category">
                  @if ($errors->has('currency_sign'))
                <div class="alert alert-danger">{{ $errors->first('currency_sign') }}</div>
                @endif
                </div>
                 <div class="form-group col-md-4">
                  <label for="currency_code">Currency Code</label>
                  <input type="text" class="form-control" name="currency_code" id="currency_code" value="{{ $site->currency_code}}" placeholder="Enter Help Category">
                  @if ($errors->has('currency_code'))
                <div class="alert alert-danger">{{ $errors->first('currency_code') }}</div>
                @endif
                </div>
          </div>
        </div>

        <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Social media Settings
                <small></small>
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
               <!--  <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button> -->
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
                <div class="box-body pad">
                   <div class="form-group col-md-4">
                  <label for="facebook_id">Facebook</label>
                  <input type="text" class="form-control" name="facebook_id" id="facebook_id" value="{{ $site->facebook_id}}" placeholder="Enter Help Category">
                  @if ($errors->has('facebook_id'))
                  <div class="alert alert-danger">{{ $errors->first('facebook_id') }}</div>
                  @endif
                  </div>
                  <div class="form-group col-md-4">
                    <label for="linkedin_id">Linkedin</label>
                    <input type="text" class="form-control" name="linkedin_id" id="linkedin_id" value="{{ $site->linkedin_id}}" placeholder="Enter Help Category">
                    @if ($errors->has('linkedin_id'))
                  <div class="alert alert-danger">{{ $errors->first('linkedin_id') }}</div>
                  @endif
                  </div>
                <div class="form-group col-md-4">
                    <label for="twitter_id">Twitter</label>
                    <input type="text" class="form-control" name="twitter_id" id="twitter_id" value="{{ $site->twitter_id}}" placeholder="Enter Help Category">
                    @if ($errors->has('twitter_id'))
                  <div class="alert alert-danger">{{ $errors->first('twitter_id') }}</div>
                  @endif
                  </div>
                <div class="form-group col-md-4">
                    <label for="instagram_id">Instagram</label>
                    <input type="text" class="form-control" name="instagram_id" id="instagram_id" value="{{ $site->instagram_id}}" placeholder="Enter Help Category">
                    @if ($errors->has('instagram_id'))
                  <div class="alert alert-danger">{{ $errors->first('instagram_id') }}</div>
                  @endif
                  </div>
                   <div class="form-group col-md-4">
                      <label for="youtube">Youtube</label>
                      <input type="text" class="form-control" name="youtube" id="youtube" value="{{ $site->youtube}}" placeholder="Enter Help Category">
                      @if ($errors->has('youtube'))
                      <div class="alert alert-danger">{{ $errors->first('youtube') }}</div>
                      @endif

                   </div> 
                    <div class="form-group col-md-4">
                      <label for="google_analytics_code">Google Analytics</label>
                      <input type="text" class="form-control" name="google_analytics_code" id="google_analytics_code" value="{{ $site->google_analytics_code}}" placeholder="Enter Google Analytics">
                      @if ($errors->has('google_analytics_code'))
                    <div class="alert alert-danger">{{ $errors->first('google_analytics_code') }}</div>
                    @endif
                    </div> 
                </div>
              
                  <div class="box-footer pull-right" >
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </div>
        <!-- /.col-->
      </div>
      </div>
      </form>
      <!-- ./row -->
    </section>
  @endsection

