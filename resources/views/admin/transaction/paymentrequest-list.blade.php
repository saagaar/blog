@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Request</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              
             <table id="example2" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Requested Amount </th>
                  <th>Status</th>
                  <th>Created at</th>
                  <th colspan="2">Action</th>
                 </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if (!$paymentRequest->isEmpty())
                @foreach ($paymentRequest as $data)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td><a href="{{route('account.view',$data->user->id)}}"> {{$data->user->name}}</td>
                  <td>
                  @if($data->status=='1')
                    <span class="label label-warning label-large"> {{$data->amount}}</span>
                  @endif
                   @if($data->status=='2')
                    <span class="label label-success label-large"> {{$data->amount}}</span>
                  @endif
                  @if($data->status=='3')
                    <span class="label label-danger label-large"> {{$data->amount}}</span>
                  @endif
                  </td>
                  
                   <td>
                        <span class="label label-danger label-large">{{($data->status=='1')?'Pending':(($data->status=='2')?'Completed':'Rejected')}}</span>
                  </td>
                  <td>{{$data->created_at->diffforhumans()}}</td>
                  @if($data->status=='1')
                  <td><a href="#" data-userid="{{$data->user->id}}" data-amount="{{$data->amount}}" data-paymentrequestid="{{$data->id}}" id="completepaymentclose" class="btn btn-block btn-success btn-sm">Complete</a></td>
                  <td><a href="#" class="btn btn-block btn-danger btn-sm" id="rejectpaymentrequestbtn" data-userid="{{$data->user->id}}" data-amount="{{$data->amount}}" data-paymentrequestid="{{$data->id}}">Reject</a></td>
                  @endif
                </tr> 
                @endforeach
                @else
                    <tr>
                    <td colspan="10" align="center" style="background-color: #d2d6de;"> No Request  Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $paymentRequest->links() !!}
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modal-reject">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title">Please Provide Reason to Reject?</h4>
          </div>
        <form name="submit-reject-message" method="post" >

          <div class="modal-body">
           <textarea cols="80" rows="5" name="reject_reason" placeholder="Reject Reason" id="reject_reason_text"></textarea>
           <p class="text text-danger hidden" id="message"> This field is Required</p>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="submitrejectrequest">Update</button>
          </div>
        </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

<div class="modal fade" id="modal-accept">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title">Reference of Payment </h4>
          </div>
        <form name="submit-complete-payment" method="post" >
        
          <div class="modal-body">
           <textarea cols="80" rows="5" name="remarks" placeholder="Reference of Payment" id="reference_payment"></textarea>
           <p class="text text-danger hidden" id="message"> This field is Required</p>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="submitcompleterequest">Update</button>
          </div>
        </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

@endsection