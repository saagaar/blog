@extends('frontend.layouts.app')
@section('content')
@if($seo)
  @section('meta_url',config('settings.url').'/contact-us')
  @section('meta_title',$seo->meta_title)
  @section('meta_description',$seo->meta_description)
  @section('meta_keyword',$seo->meta_key)
  @section('schema1',$seo->schema1)
  @section('schema2',$seo->schema2)
@endif
<section class="contact-section area-padding">
    <div class="container">

      <div class="row">
        <div class="col-12">
          <h2 class="contact-title">Get in Touch</h2>
        </div>
        <div class="col-lg-8">
          <contact :colclass="'col-6'" :colsno="20" :rowsno="9"></contact>
        </div>

        <div class="col-lg-4">
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-home"></i></span>
            <div class="media-body">
              <h3>Address :{{config('settings.city').' , '.config('settings.state').' , '.config('settings.country')}}</h3>
              <p>{{config('settings.address')}}</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
            <div class="media-body">
              <h3><a href="tel:454545654">{{config('settings.contact_number')}}</a></h3>
              <p>Mon to Fri 9am to 6pm</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-email"></i></span>
            <div class="media-body">
              <h3><a href="mailto:{{config('settings.contact_email')}}">{{config('settings.contact_email')}}</a></h3>
              <p>Send us your query anytime!</p>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>

<!-- <div class="d-none d-sm-block">
    <div class="mapouter">
        <div class="gmap_canvas">
            <iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=idata%20solution&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
            </div>
        </div>    
</div> -->

    </div>
  </section>
  @endsection