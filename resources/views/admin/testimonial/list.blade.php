@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Testimonials</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="{{route('testimonial.create')}}" class="btn btn-primary">Add Testimonials</a>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             @component('layouts.components.search' )
             @endcomponent  
             <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th colspan="2">Action</th>
                 </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if (!$testimony->isEmpty())
                @foreach ($testimony as $testimonial)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{$testimonial->name}}</td>
                   <td>{{$testimonial->position }}</td>
                   <td>{{$testimonial->description }}</td>
                   <td><img src="{{asset('uploads/testimonial-images/'.$testimonial->image) }}" alt="Testimonial Image" height="42" width="42"></td>
                  <td>
                    <input data-id="{{$testimonial->id}}" data-url="{{route('testimonial.changestatus')}}" style="font-size:5px;padding:0px;" data-width="80" data-height="25" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive"{{$testimonial->status==1 ? 'checked' : ''}}>
                      </td>             
                  <td>{{$testimonial->created_at}}</td>
                  <td>{{$testimonial->updated_at}}</td>
                  <td><a href="{{route('testimonial.edit',$testimonial->id)}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                  <td><a onClick="return ConfirmDelete();" href="{{route('testimonial.delete', $testimonial->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr> 
                @endforeach
                @else
                    <tr>
                    <td colspan="9" align="center" style="background-color: #d2d6de;"> No Testimonials Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $testimony->links() !!}
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>

@endsection