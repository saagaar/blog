@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Gallery Categories</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="{{route('gallerycategory.create')}}" class="btn btn-primary">Add Gallery Category</a>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             @component('layouts.components.search' )
             @endcomponent
             	
            </div>
            <hr>
            <div class="box-body">
            	<div class="container">
            		<h1 class="align-center">{{$category->title}}</h1>
            		<br>
					<div class="gallery">
            @if($gallery)
						@foreach($gallery as $data)
									<a href="{{ asset('uploads/gallery/'.$data['image']) }}" class="big"><img src="{{ asset('uploads/gallery/'.$data['image']) }}" alt="" title="{{$data['title']}}" /></a>
									@endforeach
            @else
            <p> No Images Found</p>
            @endif
						<div class="clear"></div>

					</div>
				</div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>

@endsection