@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Transactions</h3>
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
                  <th>User</th>
                  <th>Reference</th>
                  <th>Amount</th>
                  <th>Debit /Credit</th>
                  <th>Remarks</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th colspan="2">Action</th>
                 </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if (!$transaction->isEmpty())
                @foreach ($transaction as $data)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{$data->user->name}}</td>
                  <td>
                   {{$data->reference}}
                  </td>
                  <td>{{$data->amount}}</td>   
                   <td>
                      {{$data->remarks}}
                   </td>                                        
                  <td>{{$data->created_at->diffforhumans()}}</td>
                  <td>{{$data->updated_at->diffforhumans()}}</td>
                 
                </tr> 
                @endforeach
                @else
                    <tr>
                    <td colspan="10" align="center" style="background-color: #d2d6de;"> No Transactions Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $transaction->links() !!}
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>

@endsection