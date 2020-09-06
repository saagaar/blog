@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header  with-border">
              <h3 class="box-title">All users Account</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="{{route('account.create')}}" class="btn btn-primary">Add users account</a>
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
                  <th>Email</th>
                  <th>Roles</th>
                  <th>Points</th>
                  <th>Status</th>
                  <th>Published blog Count </th>
                  <th>Created at</th>
                  <th colspan="3">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                 $i = 0; ?>
                @if(!$account->isEmpty())
                @foreach ($account as $user)
                
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                                    @foreach ($user->roles()->pluck('name') as $role)
                                        <span class="label label-info label-large">{{ $role }}</span>
                                    @endforeach
                  </td>
                  <td>
                    <span class="label label-warning"> {{$user->point}}</span>
                  </td>

                  <td>
                    @if($user->status=='1')
                    <span class="label label-success label-large">Active</span>
                    @elseif ($user->status=='2')
                    <span class="label label-danger label-large">Inactive</span>
                    @elseif ($user->status=='3')
                    <span class="label label-warning label-large">Closed</span>
                    @elseif ($user->status=='4')
                    <span class="label label-default label-large">Suspended</span>
                    @endif
                  </td>
                  <td><a href="/admin/view/account/{{$user->id}}">{{$user->published_blogs_count}}</a></td>
                  <td>{{$user->created_at->diffForHumans()}}</td>
                  <td><a href="{{route('account.view',$user->id)}}"><i class="fa fa-eye"  aria-hidden="true"></i></a></td>
                   <td><a href="{{route('account.edit',$user->id)}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                    <td><a title="Resend Activation Link" href="{{route('admin.resend_activation',$user->username)}}"><i class="fa fa-share-square-o"  aria-hidden="true"></i></a>
                    </td>
                    <td><a onClick="return ConfirmDelete();" href="{{route('account.delete', $user->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                     </td>
                      
                </tr>
                @endforeach
                @else
                    <tr>
                    <td colspan="8" align="center" style="background-color: #d2d6de;"> No Users Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $account->links() !!}
              </ul>
            </div>
            
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>
@endsection