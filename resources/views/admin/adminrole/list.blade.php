@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header  with-border">
              <h3 class="box-title">All Admin Roles</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="{{route('adminrole.create')}}" class="btn btn-primary">Add Roles</a>
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
                  <th>Slug</th>
                  <th>Status</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th colspan="3">Action</th>
                </tr>
                </thead>
                <tbody>
                @php  $i = 0 @endphp    
                @if (!$adminRoles->isEmpty())
                  @foreach ($adminRoles as $adminRole)                 
                  <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{$adminRole->role_name }}</td>
                    <td>{{$adminRole->slug}}</td>
                    <td>
                         <input data-id="{{$adminRole->id}}" data-url="{{route('adminrole.change')}}" style="size: 12px;" data-width="75" data-height="25" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $adminRole->status==1 ? 'checked' : '' }}>
                    </td>
                    <td>{{$adminRole->created_at}}</td>
                    <td>{{$adminRole->updated_at}}</td>
                    
                         <td><a href="{{route('adminrole.managepermission', $adminRole->id)}}"><i class="fa fa-gears"  aria-hidden="true"></i></a></td>
                        <td><a href="{{route('adminrole.edit', $adminRole->id)}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                        <td><a onClick="return ConfirmDelete();" href="{{route('adminrole.delete', $adminRole->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                       </td>
                  </tr>
                  @endforeach
                  @else
                    <tr>
                    <td colspan="7" align="center" style="background-color: #d2d6de;">No Admin Role Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $adminRoles->links() !!}
              </ul>
            </div>
            
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>
@endsection