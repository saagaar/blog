@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header  with-border">
              <h3 class="box-title">All Audits List</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  
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
                  <th width="2%">id</th>
                  <th width="5%">Model</th>
                  <th width="3%">Action</th>
                  <th width="4%">Time</th>
                  <th width="2%">Url</th>
                  <th width="3%">Ip_adrress</th>
                  <th width="10%">Agent</th>
                  <th width="2%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if(!$audits->isEmpty())
                @foreach ($audits as $audit)
                
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $audit->auditable_type }} (id: {{ $audit->auditable_id }})</td>
                  <td>{{ $audit->event }}</td>
                  <td>{{ $audit->created_at }}</td>
                  <td title="{{$audit->url}}"><a href="{{$audit->url}}"> {{ str_limit( $audit->url, $limit = 20, $end = '...') }}</a></td>
                  <td>{{ $audit->ip_address }}</td>
                  @php
                  $agent = explode('/',$audit->user_agent)
                  @endphp
                  <td title="{{$audit->user_agent}}">{{ $agent[0].'/'.$agent[1] }}</td>
                  <td><a href="{{route('ip.block',$audit->ip_address)}}" title='Block IP' class="block"><i class="fa fa-ban" aria-hidden="true"></i></a></td>
                </tr>
                @endforeach
                @else
                    <tr>
                    <td colspan="8" align="center" style="background-color: #d2d6de;"> No Audit Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $audits->links() !!}
              </ul>
            </div>
            
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>
@endsection