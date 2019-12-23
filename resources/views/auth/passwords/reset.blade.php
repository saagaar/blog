@extends('frontend.layouts.app')
@section('content')
<!-- Landing Page Contents
    ================================================= -->
    <div id="lp-register">
        <div class="container wrapper">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-right-1">
            <div class="intro-texts">
                <h1 class="text-white">Make Cool Friends !!!</h1>
                <p>Blog Sagar is a social network Site that can be used to connect people. The website offers Landing pages, News Feed, Image/Video Feed, Chat Box, Timeline and lot more. <br /> <br />Why are you waiting for? Join it now.</p>
              <button class="btn btn-primary">Learn More</button>
            </div>
          </div>
            <div class="col-sm-5">
            <div class="reg-form-container forgot_pw"> 
            
              <!-- Register/Login Tabs-->
              <!-- <div class="reg-options">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#register" class="active" data-toggle="tab">Register</a></li>
                  <li><a href="#login" data-toggle="tab">Login</a></li>
                </ul>
              </div> -->
              
              <!--Registration Form Contents-->
              <div class="tab-content">
                
                <!--Login-->
                <div class="tab-pane active" id="login">
                  <h3>Reset Pasword</h3>
                  <p class="text-muted">Give your registered email id and enter new password.</p>
                  
                  <!--Login Form-->
                  <form method="POST" action="{{ route('password.request') }}" name="Login_form" id='Login_form'>
                    {{ csrf_field() }}
                     <div class="row">
                      <div class="form-group col-sm-12">
                        <label for="my-email" class="sr-only">Email</label>
                        <input id="my-email" class="form-control input-group-lg" type="text" name="email" title="Enter Email" placeholder="Your Email"/>
                        @if ($errors->has('email'))
                                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                                    @endif
                      </div>
                      <div class="form-group col-sm-12">
                        <label for="my-email" class="sr-only">New Password</label>
                        <input id="my-email" class="form-control input-group-lg" type="password" name="password" title="Enter password"  placeholder="New Password"/>
                        @if ($errors->has('password'))
                                        <p class="help is-danger">{{ $errors->first('password') }}</p>
                                    @endif
                      </div>
                      <div class="form-group col-sm-12">
                        <label for="my-email" class="sr-only">Confirm password</label>
                        <input id="my-email" class="form-control input-group-lg" type="password" name="password_confirmation" title="Enter Password Confirmation" placeholder="Your Password Confirmation"/>
                        @if ($errors->has('password_confirmation'))
                            <p class="help is-danger">{{ $errors->first('password_confirmation') }}</p>
                        @endif
                      </div>
                    </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Reset</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
@endsection
