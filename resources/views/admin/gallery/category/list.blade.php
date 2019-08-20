@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Gallery Caterories</h3>
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
                @if (!$categorys->isEmpty())
                @foreach ($categorys as $eachcat)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $eachcat->title }}</td>
                   <td>
                   	<img src="{{ asset('images/gallerycat-images/'.$eachcat['banner_image']) }}" alt="Image" height="42" width="42"></td>
                  <td>
                      @if ($eachcat->status == '0')
                        <span class="label label-success">Active</span>
                      @else
                        <span class="label label-danger">Inactive</span>
                      @endif
                  </td>
                  <td>{{$eachcat->created_at}}</td>
                  <td>{{$eachcat->updated_at}}</td>
                  <td><a href="{{route('gallerycategory.edit',[ $eachcat->id])}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                  <td><a href="{{route('gallerycategory.view',$eachcat->id)}}"><i class="glyphicon glyphicon-picture"  aria-hidden="true"></i></a></td>
                  <td><a href="{{route('gallerycategory.delete', $eachcat->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
                @endforeach
                @else
                    <tr>
                    <td colspan="9" align="center" style="background-color: #d2d6de;"> No Categorys Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $categorys->links() !!}
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>

@endsection