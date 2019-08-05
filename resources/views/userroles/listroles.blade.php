@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header  with-border">
              <h3 class="box-title">All User Roles</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="{{route('roles.create')}}" class="btn btn-primary">Add User Roles</a>
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
                  <th>Guard Name</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th colspan="3">Action</th>
                </tr>
                </thead>
                <tbody>
                @php  $i = 0 @endphp    
                @if (!$roles->isEmpty())
                  @foreach ($roles as $role)
                  
                  <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{$role->guard_name}}</td>
                    <td>{{$role->created_at}}</td>
                    <td>{{$role->updated_at}}</td>
                    
                        <td><a href="{{route('adminrole.edit', $adminrole->id)}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                        <td><a href="{{route('adminrole.delete', $adminrole->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                       </td>
                  </tr>
                  @endforeach
                  @else
                    <tr>
                    <td colspan="7" align="center" style="background-color: #d2d6de;"> No Admin Role Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $roles->links() !!}
              </ul>
            </div>
            
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>
@endsection