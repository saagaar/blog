@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Blogs</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="{{route('testimonial.create')}}" class="btn btn-primary">Add Blogs</a>
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
                  <th>id</th>
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
                   <td><img src="{{'images/blogimages/'.$testimonial['image'] }}" alt="Blog Image" height="42" width="42"></td>
                  <td>
                      @if ($testimonial->status== '1')
                        <span class="label label-danger">Active</span>
                      @else
                        <span class="label label-success">Inactive</span>
                      @endif
                  
                  <td>{{$testimonial->created_at}}</td>
                  <td>{{$testimonial->updated_at}}</td>
                  <td><a href="{{route('testimonial.edit',$testimonial->id)}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                  <td><a href="{{route('testimonial.delete', $testimonial->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
                @endforeach
                @else
                    <tr>
                    <td colspan="9" align="center" style="background-color: #d2d6de;"> No Blogs Found </td>
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