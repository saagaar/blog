@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Subscription Managers</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
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
                  <th>ID</th>
                  <th>Email</th>
                  <th>Comment</th>
                  <th>Status</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th colspan="2">Action</th>
                 </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if (!$Subscription->isEmpty())
                @foreach ($Subscription as $member)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{$member->email}}</td>
                   <td>{{$member->comment }}</td>
                   <td>
                      <input data-id="{{$member->id}}" data-url="{{route('subscription.changestatus')}}" style="font-size:5px;padding:0px;"  data-width="100" data-height="25" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Subscribe" data-off="Unsubscribe"{{$member->status ? 'checked' : '' }}>
                      </td>              
                  <td>{{$member->created_at}}</td>
                  <td>{{$member->updated_at}}</td>
                  <td><a href="{{route('subscription.edit',$member->id)}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                @endforeach
                @else
                    <tr>
                    <td colspan="9" align="center" style="background-color: #d2d6de;"> No Subscription Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $Subscription->links()!!}
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>

@endsection