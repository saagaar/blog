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
             <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Title</th>
                  <th>Banner Image</th>
                  <th>Status</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th colspan="3">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if (!$categories->isEmpty())
                @foreach ($categories as $eachCat)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $eachCat->title }}</td>
                   <td>
                   <img src="{{asset('images/gallery-cat-images/'.$eachCat->banner_image) }}" alt="Gallery Categories Image" height="42" width="42"></td>
                  <td>
                     <input data-id="{{$eachCat->id}}" data-url="{{route('gallerycategory.changestatus')}}" style="size: 12px;"  data-width="80" data-height="25" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive"{{$eachCat->status==1 ? 'checked' : '' }}>
                  </td>
                  <td>{{$eachCat->created_at}}</td>
                  <td>{{$eachCat->updated_at}}</td>
                  <td><a href="{{route('gallerycategory.edit',[ $eachCat->id])}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                  <td><a href="{{route('gallerycategory.view',[$eachCat->id])}}"><i class="glyphicon glyphicon-picture"  aria-hidden="true"></i></a></td>
                  <td><a href="{{route('gallerycategory.delete', $eachCat->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
                @endforeach
                @else
                    <tr>
                    <td colspan="9" align="center" style="background-color: #d2d6de;"> No Categories Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $categories->links() !!}
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>

@endsection