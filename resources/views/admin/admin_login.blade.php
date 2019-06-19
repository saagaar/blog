<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="icon" type="image/png" href="{{ asset('adminlogin/images/icons/favicon.ico') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('adminlogin/vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('adminlogin/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('adminlogin/fonts/iconic/css/material-design-iconic-font.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('adminlogin/vendor/animate/animate.css') }}">	
	<link rel="stylesheet" type="text/css" href="{{ asset('adminlogin/vendor/css-hamburgers/hamburgers.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('adminlogin/vendor/animsition/css/animsition.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('adminlogin/vendor/select2/select2.min.css') }}">	
	<link rel="stylesheet" type="text/css" href="{{ asset('adminlogin/vendor/daterangepicker/daterangepicker.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('adminlogin/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('adminlogin/css/main.css') }}">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('{{ asset('adminlogin/images/bg-01.jpg') }}">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				@if(Session::has('flash_message_error'))
				<div class="alert alert-danger alert-block">
						<button type="button" class="close" data-dismiss="alert">x</button>
						<strong>Error! </strong>{!!session('flash_message_error')!!}
				</div>
				@endif
				@if(Session::has('flash_message_success'))
				<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">x</button>
						<strong>Success! </strong>{!!session('flash_message_success')!!}
				</div>
				@endif
                <form class="login100-form validate-form" method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
					<span class="login100-form-title p-b-49">
						Login
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Type your username">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
						  @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                         @endif
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Type your password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
						 @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
					</div>
					@if (Route::has('password.request'))
					<div class="text-right p-t-8 p-b-31">
						<a href="{{ route('password.request') }}">
							Forgot password?
						</a>
					</div>
					@endif
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>
					
				</form>
			</div>
		</div>
	</div>
	
	
	<script src="{{ asset('adminlogin/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('adminlogin/vendor/animsition/js/animsition.min.js') }}"></script>
	<script src="{{ asset('adminlogin/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('adminlogin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('adminlogin/vendor/select2/select2.min.js') }}"></script>
	<script src="{{ asset('adminlogin/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('adminlogin/vendor/daterangepicker/daterangepicker.js') }}"></script>
	<script src="{{ asset('adminlogin/vendor/countdowntime/countdowntime.js') }}"></script>
	<script src="{{ asset('adminlogin/js/main.js') }}"></script>
	<script type="text/javascript">
	$(document).ready(function () {
	window.setTimeout(function() {
		$(".alert").fadeTo(1000, 0).slideUp(1000, function(){
			$(this).remove(); 
		});
	}, 5000);
	});
	</script>

</body>
</html>