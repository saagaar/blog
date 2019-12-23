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
                  <h3>Forgot Pasword</h3>
                  <p class="text-muted">Give your registered email id and we will
send you password reset email.</p>
                  
                  <!--Login Form-->
                  <form  method="POST" action="{{ route('password.email') }}" name="Login_form" id='Login_form'>
                    {{ csrf_field() }}
                     <div class="row">
                      <div class="form-group col-sm-12">
                        <label for="my-email" class="sr-only">Email</label>
                        <input id="my-email" class="form-control input-group-lg" type="text" name="email" title="Enter Email" placeholder="Your Email" value="{{ old('email') }}"/>
                        @if ($errors->has('email'))
                                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                                    @endif
                      </div>
                    </div>
                  
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
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
