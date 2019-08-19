@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header  with-border">
              <h3 class="box-title">All Blocklist</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="{{route('blocklist.create')}}" class="btn btn-primary">Add Blocklist </a>
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
                  <th>Ip Address</th>
                  <th>Message</th>
                  <th>Status</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th colspan="3">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if(!$ipdata->isEmpty())
                @foreach ($ipdata as $ipvalue)
                
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $ipvalue->ip_address }}</td>
                  <td>{{ $ipvalue->message }}</td>
                  <td>
                      @if($ipvalue->status=='black')
                       <span class="label label-danger">Blocked</span>
                       @elseif(($ipvalue->status=='white'))
                       <span class="label label-success">Active</span>
                       @else
                       <span class="label label-primary">Grey</span>
                       @endif
                  </td>
                  <td>{{$ipvalue->created_at}}</td>
                  <td>{{$ipvalue->updated_at}}</td>
                      
                      <td><a href="{{route('blocklist.edit',$ipvalue->id)}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                      <td>
                       <a href="{{route('blocklist.delete',$ipvalue->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                     </td>
                </tr>
                @endforeach
                @else
                    <tr>
                    <td colspan="8" align="center" style="background-color: #d2d6de;"> No CMS Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $ipdata->links() !!}
              </ul>
            </div>
            
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>
@endsection