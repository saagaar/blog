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
                @if (!$Banner->isEmpty())
                @foreach ($Banner as $data)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{$data->title}}</td>
                   <td>{{strip_tags(str_replace('&nbsp;','',$data->content))}}</td>
                   <td><img src="{{asset('images/banner-images/'.$data->image) }}" alt="banner Image" height="42" width="42"></td>
                   <td>{{$data->display_order }}</td>
                  <td>
                      @if ($data->status== 'Y')
                        <span class="label label-success">Published</span>
                      @else
                        <span class="label label-danger">Unpublished</span>
                      @endif
                      </td>             
                  <td>{{$data->created_at}}</td>
                  <td>{{$data->updated_at}}</td>
                  <td><a href="{{route('banner.edit',$data->id)}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                  <td><a href="{{route('banner.delete', $data->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
              {!! $Banner->links() !!}
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>

@endsection