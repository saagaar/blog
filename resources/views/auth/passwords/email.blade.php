@extends('frontend.layouts.app')
@section('content')
<!-- Landing Page Contents
    ================================================= -->
    <div id="lp-register">
        <div class="container wrapper">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-right-1">
            <div class="intro-texts">
                <h1 class="text-white">Enjoy Learning !!!</h1>
                  <p>Thebloggersclub.com is an online blogging platform for all as simple as it is. It is a community of writers and readers who can connect and share their stories to develop a learning environment among the users..</p>
              <a href="/home" class="btn btn-primary" >Explore Us</a>
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
                  <p class="text-muted">Use Your email to reset password.You will receive an email with  reset link.</p>
                  
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
