@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header  with-border">
              <h3 class="box-title">All Admin users</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  
                  <a href="{{route('adminuser.create')}}" class="btn btn-primary">Add users</a>
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
                  <th>Username</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Role</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if(!$adminusers->isEmpty())
                @foreach ($adminusers as $adminuser)
                
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $adminuser->username }}</td>
                  <td>{{ $adminuser->email }}</td>
                  <td>
                       <input data-id="{{$adminuser->id}}" data-url="{{route('adminuser.changestatus')}}" style="size: 12px;"  data-width="80" data-height="25" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $adminuser->status ? 'checked' : '' }}>
                  </td>
                  <td>{{$adminuser->role_id}}</td>
                  <td>{{$adminuser->created_at}}</td>
                  <td>{{$adminuser->updated_at}}</td>                
                      <td><a href="{{route('adminuser.edit', $adminuser->id)}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                      <td><a href="{{route('adminuser.delete', $adminuser->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                     </td>
                </tr>
                @endforeach
                @else
                    <tr>
                    <td colspan="8" align="center" style="background-color: #d2d6de;"> No Admin Users Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $adminusers->links() !!}
              </ul>
            </div>
            
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>

@endsection