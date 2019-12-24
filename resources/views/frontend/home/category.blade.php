@extends('frontend.layouts.app')
@section('content')
<section class="fullwidth-block area-padding-bottom area-padding-top">
	<div class="container">
		<section class="category-page category-list">
			<div id="main" class="">
				@foreach($allCategory as $eachCategories)
	            <div class="row">
	                <div class="col-md-12">
	                    <div class="area-heading">
	                        <h3>{{$eachCategories->name}}</h3>
	                    </div>
	                </div>
	                <div class="clearfix"></div>
	            </div>

	            <div class="row">
	            	@foreach($eachCategories->categories as $subCategories)
	                <div class="col-lg-4 col-md-3 col-sm-6">
	                    <div class="single-category">
	                        <div class="thumb">
	                           <a href="#"> 
	                           	@if($subCategories->banner_image)
                            	<img class="img-fluid" src="{{ asset('/uploads/categories-images/'.$subCategories->banner_image) }}" alt="">
                            @else
                            	<img class="img-fluid" src="/frontend/images/elements/default-post.jpg" alt="{{ $eachBlog->title }}">
                            @endif
	                           </a>
	                        </div>
	                        <div class="short_details">
	                            <a class="d-block" href="{{asset('getblogbycategory',$subCategories->slug)}}">
	                                <h4>{{$subCategories->name}}</h4>
	                            </a>
	                        </div>
	                    </div> 
	                </div>
	                @endforeach
	                <div class="clearfix"></div>
	                </div>
	            @endforeach
        	</div>
    	</section>
	</div>
</section>
@endsection