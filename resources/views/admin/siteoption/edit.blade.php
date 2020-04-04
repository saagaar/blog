@extends('layouts.common.main')
@section('content') 

  <section class="content">
  <form action="{{route('sitesetting')}}" method="POST" enctype="multipart/form-data">
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
                    <label for="url">Site URL</label>
                    <input type="text" class="form-control" name="url" id="url" value="{{ $site->url}}" placeholder="Site Name">
                    @if ($errors->has('url'))
                    <div class="alert alert-danger">{{ $errors->first('url') }}</div>
                    @endif
                  </div>
                                  
               <div class="form-group col-md-4">
                  <label for="image">Image Upload</label>
                  <input type="file" class="form-control" name="image" id="image">
                  <img src='/uploads/sitesettings-images/{{$site->image}}' width="50"/>
                  @if ($errors->has('image'))
                  <div class="alert alert-danger">{{ $errors->first('image') }}</div>
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
                          <label for="user_requires_activation">User requires activation: </label>
                            <input type="radio"  class="flat-red user_requires_activation" name="user_requires_activation"  value="Y" {{ $site->user_requires_activation == 'Y' ? 'checked' : ''}}>Yes 
                          <label><input type="radio" class="flat-red"  name="user_requires_activation" value="N"  {{ $site->user_requires_activation == 'N' ? 'checked' : ''}}>No</label>
                          @if ($errors->has('user_requires_activation'))
                        <div class="alert alert-danger">{{ $errors->first('user_requires_activation') }}</div>
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
                      <label for="maintainence">Maintainence Key</label>
                      <input type="text" class="form-control" name="maintainence" id="maintainence" value="{{ $site->maintainence}}" placeholder="Enter Google Analytics">
                      @if ($errors->has('maintainence'))
                    <div class="alert alert-danger">{{ $errors->first('maintainence') }}</div>
                    @endif
                    </div>

                   <div class="form-group col-md-4">
                    <label for="message">Message: </label>
                    <textarea name="message" class="form-control" rows="5" placeholder="Enter Your Message here..">{{ $site->message}}</textarea>
                     @if ($errors->has('message'))
                    <div class="alert alert-danger">{{ $errors->first('message') }}
                    </div>
                    @endif
                    </div>
                 
                 <div class="form-group col-md-4">
                      <label for="duration">Duration</label>
                      <input type="text" class="form-control" name="duration" id="duration" value="{{ $site->duration}}" placeholder="Enter Duration">
                      @if ($errors->has('duration'))
                    <div class="alert alert-danger">{{ $errors->first('duration') }}</div>
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
                          <label for="blog_requires_activation">Approve Post: </label>
                          <label><input type="radio" class="flat-red" name="blog_requires_activation" value="Y" {{ $site->blog_requires_activation == 'Y' ? 'checked' : ''}}>Yes</label>
                          <label><input type="radio" class="flat-red" name="blog_requires_activation" value="N"  {{ $site->blog_requires_activation == 'N' ? 'checked' : ''}}>No</label>
                          @if ($errors->has('blog_requires_activation'))
                        <div class="alert alert-danger">{{ $errors->first('blog_requires_activation') }}</div>
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
                  <label for="facebook_url">Facebook</label>
                  <input type="text" class="form-control" name="facebook_url" id="facebook_url" value="{{ $site->facebook_url}}" placeholder="Enter Facebook Url">
                  @if ($errors->has('facebook_url'))
                  <div class="alert alert-danger">{{ $errors->first('facebook_url') }}</div>
                  @endif
                  </div>
                  <div class="form-group col-md-4">
                    <label for="linkedin_id">Linkedin</label>
                    <input type="text" class="form-control" name="linkedin_url" id="linkedin_url" value="{{ $site->linkedin_url}}" placeholder="Enter Linkedin Url">
                    @if ($errors->has('linkedin_url'))
                  <div class="alert alert-danger">{{ $errors->first('linkedin_url') }}</div>
                  @endif
                  </div>
                <div class="form-group col-md-4">
                    <label for="twitter_id">Twitter</label>
                    <input type="text" class="form-control" name="twitter_url" id="twitter_url" value="{{ $site->twitter_url}}" placeholder="Enter twitter url">
                    @if ($errors->has('twitter_url'))
                  <div class="alert alert-danger">{{ $errors->first('twitter_url') }}</div>
                  @endif
                  </div>
                <div class="form-group col-md-4">
                    <label for="instagram_url">Instagram</label>
                    <input type="text" class="form-control" name="instagram_url" id="instagram_url" value="{{ $site->instagram_url}}" placeholder="Enter your instagram url">
                    @if ($errors->has('instagram_url'))
                  <div class="alert alert-danger">{{ $errors->first('instagram_url') }}</div>
                  @endif
                  </div>
                   <div class="form-group col-md-4">
                      <label for="youtube_url">Youtube</label>
                      <input type="text" class="form-control" name="youtube_url" id="youtube_url" value="{{ $site->youtube_url}}" placeholder="Enter Yotube page url">
                      @if ($errors->has('youtube_url'))
                      <div class="alert alert-danger">{{ $errors->first('youtube_url') }}</div>
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
                  <button type="submit" class="btn btn-primary">Edit</button>
                </div>
        </div>
        <!-- /.col-->
      </div>
      </div>
      </form>
      <!-- ./row -->
    </section>
  @endsection

