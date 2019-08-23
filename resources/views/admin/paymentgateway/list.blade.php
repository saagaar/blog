@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Payment Gateway List</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="{{route('paymentgateway.create')}}" class="btn btn-primary">Add Payment Gateway</a>
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
                  <th>Image</th>
                  <th>Status</th>
                  <th>Mode</th>
                  <th>Created at</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th colspan="2">Action</th>
                 </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if (!$PaymentGateway->isEmpty())
                @foreach ($PaymentGateway as $data)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{$data->email}}</td>
                  <td><img src="{{asset('images/paymentgateway-images/'.$data->image) }}" alt="paymentgateway Image" height="42" width="42"></td>   
                   <td>
                         <input data-id="{{$data->id}}" data-url="{{route('paymentgateway.changestatus')}}" style="size: 12px;"  data-width="80" data-height="25" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive"{{$data->status ? 'checked' : '' }}>
                      </td>                                        
                      <td>  
                       @if($data->mode=='1')
                        <span class="label label-success">Live</span>
                      @else
                        <span class="label label-warning">Test</span>
                      @endif
                      </td>         

                  <td>{{$data->created_at}}</td>
                  <td>{{$data->updated_at}}</td>
                  <td><a href="{{route('paymentgateway.edit',$data->id)}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                  <td><a href="{{route('paymentgateway.delete', $data->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr> 
                @endforeach
                @else
                    <tr>
                    <td colspan="9" align="center" style="background-color: #d2d6de;"> No PaymentGateway lists Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $PaymentGateway->links() !!}
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>

@endsection