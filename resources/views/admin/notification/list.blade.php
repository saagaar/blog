@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All notifications</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="{{route('notification.create')}}" class="btn btn-primary">Add Notification Templete</a>
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
                  <th>Code</th>
                  <th>Active</th>
                  <th>subject</th>
                  <th>view</th>
                  <th>notification Type</th>
                  <th>Created at</th>
                  <th colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if (!$notification->isEmpty())
                @foreach ($notification as $eachNotification)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $eachNotification->title }}</td>
                   <td>{{ $eachNotification->code }}</td>
                  <td>
                   <input data-id="{{$eachNotification->id}}" data-url="{{route('notification.changestatus')}}" style="size: 12px;" data-width="80" data-height="25" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive"{{$eachNotification->active ? 'checked' : '' }}>
                  </td>
                  <td>{{ $eachNotification->subject }}</td>
                  <td>{{ $eachNotification->view }}</td>
                  <td><?php echo(implode(',', $eachNotification->notification_type)); ?></td>
                  <td>{{$eachNotification->created_at}}</td>
                  <td><a href="{{route('notification.edit', $eachNotification->id)}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                  <td><a href="{{route('notification.delete', $eachNotification->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
                @endforeach
                @else
                    <tr>
                    <td colspan="9" align="center" style="background-color: #d2d6de;"> No notifications Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $notification->links() !!}
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>

@endsection