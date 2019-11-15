@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Banners List</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="{{route('banner.create')}}" class="btn btn-primary">Add Banners</a>
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
                  <th>Title</th>
                  <th>Content</th>
                  <th>Image</th>
                  <th>Display Order</th>
                  <th>Status</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th colspan="2">Action</th>
                 </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if (!$banner->isEmpty())
                @foreach ($banner as $data)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{$data->title}}</td>
                   <td>{{strip_tags(str_replace('&nbsp;','',$data->content))}}</td>
                   <td><img src="{{asset('uploads/banner-images/'.$data->image) }}" alt="Banner Image" height="42" width="42"></td>
                   <td>{{$data->display_order }}</td>
                  <td>
                       <input data-id="{{$data->id}}" data-url="{{route('banner.changestatus')}}" style="size: 12px;"  data-width="100" data-height="25" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Publish" data-off="Unpublish"{{ $data->status==1 ? 'checked' : '' }}>
                      </td>             
                  <td>{{$data->created_at}}</td>
                  <td>{{$data->updated_at}}</td>
                  <td><a href="{{route('banner.edit',$data->id)}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                  <td><a onClick="return ConfirmDelete();" href="{{route('banner.delete', $data->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr> 
                @endforeach
                @else
                    <tr>
                    <td colspan="9" align="center" style="background-color: #d2d6de;"> No Banner lists Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $banner->links() !!}
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>

@endsection