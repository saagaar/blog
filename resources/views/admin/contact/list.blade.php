@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header  with-border">
              <h3 class="box-title">All contact</h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              @component('layouts.components.search' )
             @endcomponent  
              <table id="example2" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Status</th>
                  <th>Follow Date</th>
                  <th>Created at</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if(!$contact->isEmpty())
                @foreach ($contact as $eachcontact)
                
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $eachcontact->name }}</td>
                  <td>{{ $eachcontact->email }}</td>
                  <td>{{ $eachcontact->subject }}</td>
                  <td>{{ $eachcontact->message }}</td>
                  <td>
                      @if($eachcontact->status=='pending')
                       <span class="label label-default label-large">Pending</span>
                       @elseif($eachcontact->status=='followup')
                       <span class="label label-primary label-large">Followup</span>
                       @elseif($eachcontact->status=='contacted')
                       <span class="label label-success label-large">Contacted</span>
                       @elseif($eachcontact->status=='closed')
                       <span class="label label-danger label-large">Closed</span>
                       @endif
                  </td>
                  <td>{{$eachcontact->follow_date }}</td>
                  <td>{{$eachcontact->created_at }}</td>
                  
                  
                      <td><a href="{{route('contact.edit',$eachcontact->id)}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                </tr>
                @endforeach
                @else
                    <tr>
                    <td colspan="9" align="center" style="background-color: #d2d6de;"> No contact Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $contact->links() !!}
              </ul>
            </div>
            
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>
@endsection