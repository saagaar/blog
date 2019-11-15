@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Gallery</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="{{route('gallery.create')}}" class="btn btn-primary">Add Gallery </a>
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
                  <th>Title</th>
                  <th>Image</th>
                  <th>Category</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if (!$galleries->isEmpty())
                @foreach ($galleries as $item)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $item->title }}</td>
                   <td>
                   	<img src="{{ asset('uploads/gallery/'.$item['image']) }}" alt="Gallery Image" height="42" width="42"></td>
                   	<td>
                       @foreach ($item->categories()->pluck('title') as $category)
                                        <span class="label label-info label-large">{{ $category }}</span>
                                    @endforeach
                    </td>
                  <td>{{$item->created_at}}</td>
                  <td>{{$item->updated_at}}</td>
                  <td><a href="{{route('gallery.edit',[$item->id])}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                  <td><a onClick="return ConfirmDelete();" href="{{route('gallery.delete', $item->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
                @endforeach
                @else
                    <tr>
                    <td colspan="9" align="center" style="background-color: #d2d6de;"> No Galleries Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $galleries->links() !!}
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>

@endsection