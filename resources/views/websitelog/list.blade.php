@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Logs</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             @component('layouts.components.search' )
             @endcomponent  
             <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Ip Address</th>
                  <th>Referer Url</th>
                  <th>Visit Date</th>
                  <th>Country</th>
                  <th>Created at</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if (!$websitelog->isEmpty())
                @foreach ($websitelog as $eachlogs)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $eachlogs->ip_address }}</td>
                   <td>{{ $eachlogs->referer_url }}</td>
                  <td>{{$eachlogs->visit_date}}</td>
                  <td>{{$eachlogs->country}}</td>
                  <td>{{$eachlogs->created_at}}</td>
                  <td><button type="button"  class="btn btn-primary btn-sm viewipdetail" data-parentid="{{ $eachlogs->id }}" >
					  <i class="fa fa-pencil-square-o" ></i>
					</button>

					<!-- Modal -->
					
				  </td>
				  <td><a href="{{route('websitelog.block',$eachlogs->id)}}"><i class="fa fa-ban" aria-hidden="true"></i></a></td>
                </tr>
                @endforeach
                @else
                    <tr>
                    <td colspan="9" align="center" style="background-color: #d2d6de;"> No Logs Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $websitelog->links() !!}
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>

@endsection

<div class="modal fade" id="IpAddressDetail" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="myModalLabel">Ip Address Detail</h4>
					      </div>
					      <div class="modal-body">
					      	<div class="row">
					      		<div class=" col-md-4">
					      			<h3>IP Address</h3>
					      			<p id="ip_address"></p>
					      		</div>
					      		<div class=" col-md-4">
					      			<h3>Referer URL</h3>
					      			<p id="referer_url"></p>
					      		</div>
					      		<div class=" col-md-4">
					      			<h3>User Agent</h3>
					      			<p id="user_agent"></p>
					      		</div>
					      	</div>
					      	<div class="row">
					      		<div class=" col-md-4">
					      			<h3>Device</h3>
					      			<p id="device"></p>
					      		</div>
					      		<div class=" col-md-4">
					      			<h3>Redirected To</h3>
					      			<p id="redirected_to"></p>
					      		</div>
					      		<div class=" col-md-4">
					      			<h3>Continent</h3>
					      			<p id="continent"></p>
					      		</div>
					      	</div>
					      	<div class="row">
					      		<div class=" col-md-4">
					      			<h3>Country</h3>
					      			<p id="country"></p>
					      		</div>
					      		<div class=" col-md-4">
					      			<h3>City</h3>
					      			<p id="city"></p>
					      		</div>
					      		<div class=" col-md-4">
					      			<h3>State</h3>
					      			<p id="state"></p>
					      		</div>
					      	</div>					      	
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					       <!--  <button type="button" class="btn btn-primary">Save changes</button> -->
					      </div>
					    </div>
					  </div>
					</div>
<script type="text/javascript">
var APP_URL = {!! json_encode(url('/admin/view/websitelog')) !!}
</script>
