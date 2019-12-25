<!DOCTYPE html>
<html lang="en">
<head>
	<title>Coming Soon 1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>

    <link href="{{ asset('frontend/css/maintainence-mode.css')}}" rel="stylesheet">
</head>
<body>
	<div id="landing-page">
	
	<div class="size1 bg0 where1-parent">
		<!-- Coutdown -->
		@php
		$start = (config('settings.maintainence_start_date'));
		$today=date('Y-m-d H:i:s');
        $end = date('Y-m-d H:i:s', strtotime($start. ' + '.config('settings.maintainence_duration').' days')); 
        $diff=strtotime($end)-strtotime($today);
        $remain_date=date_diff(date_create($end),date_create($today));
		@endphp

		<div class="flex-c-m bg-img1 size2 where1 overlay1 where2 respon2" style="background-image: url('/frontend/images/background/bg-maintainence2.png');">
			@if($diff>0)
			<div class="wsize2 flex-w flex-c-m cd100 js-tilt">
				<div class="flex-col-c-m size6 bor2 m-l-10 m-r-10 m-t-15">
					<span class="l2-txt1 p-b-9 days">{{ $remain_date->d}}</span>
					<span class="s2-txt4">Days</span>
				</div>

				<div class="flex-col-c-m cd100 size6 bor2 m-l-10 m-r-10 m-t-15">
					<span class="l2-txt1 p-b-9 hours">{{ $remain_date->h }}</span>
					<span class="s2-txt4">Hours</span>
				</div>

				<div class="flex-col-c-m cd100 size6 bor2 m-l-10 m-r-10 m-t-15">
					<span class="l2-txt1 p-b-9 minutes">{{ $remain_date->i}}</span>
					<span class="s2-txt4">Minutes</span>
				</div>

				<div class="flex-col-c-m cd100 size6 bor2 m-l-10 m-r-10 m-t-15">
					<span class="l2-txt1 p-b-9 seconds">{{$remain_date->s}}</span>
					<span class="s2-txt4">Seconds</span>
				</div>
			</div>
			@endif
		</div>
		
		<!-- Form -->
		<div class="size3 flex-col-sb flex-w p-l-75 p-r-75 p-t-45 p-b-45 respon1">
			<div class="wrap-pic1">
				<img src="{{asset('uploads/sitesettings-images/'.config('settings.image'))}}" alt="LOGO">
			</div>

			<div class="p-t-50 p-b-60">
				<p class="m1-txt1 p-b-36">
					{!! config('settings.maintainence_message') !!}
				</p>

				<form method="post" action="{{route('check.maintainence')}}" class="contact100-form validate-form">
					@csrf
					<div class="wrap-input100 m-b-10 validate-input" data-validate = "Maintainence code is required">
						<input class="s2-txt1 placeholder0 input100" type="text" name="maintainence_code" placeholder="Enter maintainence code">
						<span class="focus-input100"></span>
					</div>

					<!-- <div class="wrap-input100 m-b-20 validate-input" data-validate = "Email is required: ex@abc.xyz">
						<input class="s2-txt1 placeholder0 input100" type="text" name="email" placeholder="Email Address">
						<span class="focus-input100"></span>
					</div> -->

					<div class="w-full">
						<button type="submit" class="flex-c-m s2-txt2 size4 bg1 bor1 hov1 trans-04">
							Submit
						</button>
					</div>
				</form>

				<p class="s2-txt3 p-t-18">
					And don’t worry, we hate spam too! You can unsubcribe at anytime.
				</p>
			</div>
			<newsletter></newsletter>
			<div class="flex-w">
				<a href="#" class="flex-c-m size5 bg3 how1 trans-04 m-r-5">
					<i class="fa fa-facebook"></i>
				</a>

				<a href="#" class="flex-c-m size5 bg4 how1 trans-04 m-r-5">
					<i class="fa fa-twitter"></i>
				</a>

				<a href="#" class="flex-c-m size5 bg5 how1 trans-04 m-r-5">
					<i class="fa fa-youtube-play"></i>
				</a>
			</div>
		</div>
	</div>
	</div>
  <script src="{{ asset('frontend/js/landing-page.js')}}"></script> 

<script src="{{ asset('frontend/js/maintainence.mode.js')}}"></script> 


	<script>
		var date="<?php echo $remain_date->d; ?>";
		var hour="<?php echo $remain_date->h; ?>";
		var min="<?php echo $remain_date->i; ?>";
		var sec="<?php echo $remain_date->s; ?>";
	$(document).ready(function(){

			$('.cd100').countdown100({
				/*Set Endtime here*/
				/*Endtime must be > current time*/
				endtimeYear: 0,
				endtimeMonth: 0,
				endtimeDate: date,
				endtimeHours: hour,
				endtimeMinutes: min,
				endtimeSeconds: sec,
				timeZone: "" 
				// ex:  timeZone: "America/New_York"
				//go to " http://momentjs.com/timezone/ " to get timezone
			});
				$('.js-tilt').tilt({
				scale: 1.1
			})
	})
	</script>

	<script >
	
	</script>

</body>
</html>