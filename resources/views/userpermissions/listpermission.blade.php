@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header  with-border">
              <h3 class="box-title">All permissions users</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="{{route('permission.create')}}" class="btn btn-primary">Add Users Permission</a>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              @component('layouts.components.search' )
             @endcomponent  
              <table id="example2" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Name</th>
                  <th>GuardName</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if(!$permissions->isEmpty())
                @foreach ($permissions as $permission)
                
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $permission->name }}</td>
                  <td>{{ $permission->guard_name }}</td>
                 
                  <td>{{$permission->created_at}}</td>
                  <td>{{$permission->updated_at}}</td>
                  
                      <td><a href="{{route('permission.edit',$permission->id)}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                      <td><a href="{{route('permission.delete', $permission->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                     </td>
                </tr>
                @endforeach
                @else
                    <tr>
                    <td colspan="8" align="center" style="background-color: #d2d6de;"> No permission Users Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $permissions->links() !!}
              </ul>
            </div>
            
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>
@endsection