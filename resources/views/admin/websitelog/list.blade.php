@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">All Logs</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <!-- <a href="{{route('blocklist.create')}}" class="btn btn-primary">Add Blocklist </a> -->
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
                  <th>Region</th>
                  <th>City</th>
                  <th>Country</th>
                  <th>Total Logs</th>
                  <th colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if (!$websitelog->isEmpty())
                @foreach ($websitelog as $eachlogs)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $eachlogs->ip_address }}
                  	<button type="button" title="View"  class="btnview btn btn-primary btn-sm logdetail" data-parentid="{{ $eachlogs->id }}" >
					  <i class="fa fa-eye" ></i>
					</button>
                  </td>
                   <td>{{$eachlogs->region}}</td>
                  <td>{{$eachlogs->city}}</td>
                  <td>{{$eachlogs->country}}</td>
                  <td>{{$eachlogs->count()}}</td>
                  <td><button type="button" title="View"  class="btnview btn btn-primary btn-sm viewipdetail" data-parentid="{{ $eachlogs->id }}" >
					  <i class="fa fa-eye" ></i>
					</button>

					<!-- Modal -->
					
				  </td>
				  <td><a href="{{route('websitelog.block',$eachlogs->id)}}" title='Block IP' class="block"><i class="fa fa-ban" aria-hidden="true"></i></a></td>
                </tr>
                @endforeach
                @else
                    <tr>
                    <td colspan="8" align="center" style="background-color: #d2d6de;"> No Logs Found </td>
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
					      	<div class="container-fluid">
								<div class="row">
									<div class="col-md-4">
										<h2>
											IP Address
										</h2>
										<p id="ip_address"></p>
									</div>
									
									<div class="col-md-4">
										<h2>
											User Agent
										</h2>
										<p id="user_agent"></p>
									</div>
									<div class="col-md-4">
										<h2>
											Region
										</h2>
										<p id="region"></p>
									</div>
									</div>
								<div class="row">
									<div class="col-md-12">
										<h2>
											Referer URL
										</h2>
										<p id="referer_url"></p>
									</div>
								
									
									</div>
								<div class="row">
									<div class="col-md-4">
										<h2>
											Redirected To
										</h2>
										<p id="redirected_to"></p>
									</div>
									<div class="col-md-4">
										
									</div>
									<div class="col-md-4">
										<h2>
											Last Visit Date
										</h2>
										<p id="visit_date"></p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<h2>
											Country
										</h2>
										<p id="country"></p>
									</div>
									<div class="col-md-4">
										<h2>City
										</h2>
										<p id="city"></p>
									</div>
									<div class="col-md-4">
										<h2>
											Time Zone
										</h2>
										<p id="time_zone"></p>
									</div>
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
<div class="modal fade" id="ajaxModel" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ip Address Detail</h4>
      </div>
      <div class="modal-body">
      	<table class="table table-bordered table-striped" id="laravel_datatable">
   <thead>
      <tr>
         <th>ID</th>
         <th>Ip address</th>
         <th>Referrer url</th>
         <th>Redirected to</th>
         <th>User agent</th>
         <th>Visit Date</th>
      </tr>
   </thead>
   <tbody id="listOfIpAddressDetail">
   
   </tbody>
</table>
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
