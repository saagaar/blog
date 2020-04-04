@extends('frontend.layouts.app')
@section('content')

    @if($seo)
        @section('meta_url',config('settings.url').'/home')
        @section('meta_description',$seo->meta_description)
        @section('meta_title',$seo->meta_title)
        @section('meta_keyword',$seo->meta_key)
        @if($seo->meta_image!='')
             @section('meta_image',$seo->meta_image)
        @endif
    @endif
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
	                <div class="col-lg-3 col-md-4 col-sm-6 col-6 ">
	                    <div class="single-category">
	                        <div class="thumb">
	                           <a href="{{url('category',$subCategories->slug)}}"> 
	                           	@if($subCategories->banner_image)
                            	<img class="img-fluid" src="{{ asset('/uploads/categories-images/'.$subCategories->banner_image) }}" alt="">
                            @else
                            	<img class="img-fluid" src="/frontend/images/elements/default-post.jpg" alt="{{ $subCategories->title }}">
                            @endif
	                           </a>
	                        </div>
	                        <div class="short_details">
	                            <a class="d-block" href="{{ url('category',$subCategories->slug) }}">
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