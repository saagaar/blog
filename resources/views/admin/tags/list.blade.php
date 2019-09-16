@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Tags</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="{{route('tags.create')}}" class="btn btn-primary">Add Tags</a>
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
                  <th>Status</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if (!$tags->isEmpty())
                @foreach ($tags as $tag)
                
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $tag->name }}</td>
                  <td><input data-id="{{$tag->id}}" data-url="{{route('tags.changestatus')}}" style="font-size:5px;padding:0px;" data-width="80" data-height="25" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" {{$tag->status ? 'checked' : ''}}>
                  </td>
                  <td>{{$tag->created_at}}</td>
                  <td>{{$tag->updated_at}}</td>
                  <td><a href="{{route('tags.edit', $tag->id)}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                  <td><a href="{{route('tags.delete', $tag->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
                @endforeach
                @else
                    <tr>
                    <td colspan="6" align="center" style="background-color: #d2d6de;"> No Tags Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $tags->links() !!}
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>
</div>
@endsection