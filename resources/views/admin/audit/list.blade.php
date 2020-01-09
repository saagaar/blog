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
                  <th colspan="3" width="2%">Action</th>
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
                  <td> <a href="{{route('audit.revert',$audit->id)}}" title='Block IP' class="block"><i class="fa fa-undo" aria-hidden="true"></i></a></td>
                  <td><button type="button"  class="btnview btn btn-primary btn-sm" data-toggle="modal" data-target="#AuditModal{{$audit->id}}">
                    <i class="fa fa-eye" ></i>
                  </button></td>
                </tr>
                <div class="modal fade" id="AuditModal{{$audit->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Audit Changes</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                            <ul style="list-style: none;"><strong>Old Values</strong>
                              @foreach($audit->old_values as $attribute  => $value) 
                                            <li><b>{{ $attribute  }}</b></li>
                                            <li>@if($value)
                                            {{ $value }}
                                            @else
                                            ----
                                            @endif
                                          </li>
                                    @endforeach
                              </ul>
                              <ul style="list-style: none;"><strong>New values</strong>
                              @foreach($audit->new_values as  $attribute  => $data)
                                            <li><b>{{  $attribute  }}</b></li>
                                            <li>{{ $data }}</li>
                                    @endforeach
                         </ul>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
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