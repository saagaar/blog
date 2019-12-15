@extends('frontend.layouts.app')
@section('content')
<div class="mid_part">

<!--================Dashboard Area Bikash Bhandari (bhandaribikash.com.np) =================-->
  <section class="dashboard_sec">
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-sm-12">

		<section class="white-box">
		        <div class="row">
		            <div class="col-md-12">
		                <div class="area-heading" style="padding-left: 30px;">
		                    <h3>{{$cms->heading}}</h3>
		                </div>
		            </div>
		            <div class="clearfix"></div>
		        </div>

		        <div class="cms_sec">                  
		                {!! $cms->content !!}
		                </div>


		</section>

        </div>

            <div class="clearfix"></div>
        </div>
    </div>
  </section>
  <!--================Dashboard Area =================-->
 
</div>
  

@endsection