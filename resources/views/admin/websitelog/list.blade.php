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
                  <th>Referer Url</th>
                  <th>Visit Date</th>
                  <th>Country</th>
                  <th>Created at</th>
                  <th colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if (!$websitelog->isEmpty())
                @foreach ($websitelog as $eachlogs)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $eachlogs->ip_address }}</td>
                   <td>
                   	<?php 
							$str = $eachlogs->referer_url;
								$length = strlen($str);

								if ($length < 25) {
                                  $str = mb_substr($str, 0, 25,"utf-8");
                              } else {
                                  $str = mb_substr($str, 0, 25,"utf-8");
                                  $str .= str_repeat('.', 3);
                              }
								echo $str;
							?>
                   </td>
                  <td>{{$eachlogs->visit_date}}</td>
                  <td>{{$eachlogs->country}}</td>
                  <td>{{$eachlogs->created_at}}</td>
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
											Device
										</h2>
										<p id="device"></p>
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
											Continent
										</h2>
										<p id="continent"></p>
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
											State
										</h2>
										<p id="state"></p>
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
<script type="text/javascript">
var APP_URL = {!! json_encode(url('/admin/view/websitelog')) !!}
</script>
