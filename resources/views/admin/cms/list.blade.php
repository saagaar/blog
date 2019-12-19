@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All CMS</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="{{route('cms.create')}}" class="btn btn-primary">Add CMS </a>
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
                  <th>ID</th>
                  <th>Heading</th>
                  <th>Content</th>
                  <th>Is Display</th>
                  <th>CMS type</th>
                  <th>Created at</th>
                  <!-- <th>Updated at</th> -->
                  <th colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if(!$cms->isEmpty())
                @foreach ($cms as $eachCms)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $eachCms->heading }}</td>
                  <td> {{ str_limit(strip_tags($eachCms->content), $limit = 150, $end = '...') }} </td>
                  <td>
                      <input data-id="{{$eachCms->id}}" data-url="{{route('cms.changestatus')}}" style="font-size:5px;padding:0px;" data-width="80" data-height="25" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive"{{$eachCms->status==1 ? 'checked' : ''}}>
                  </td>
                  <td>
                     @if($eachCms->cms_type=='website')
                    <span class="label label-success label-large">Website</span>
                    @else
                   <span class="label label-warning label-large ">System</span>
                  @endif
                  </td>
                  <td>{{$eachCms->created_at}}</td>
                  <!-- <td>{{$eachCms->updated_at}}</td> -->
                  
                      <td><a href="{{route('cms.edit',$eachCms->id)}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                      <td>
                      @if($eachCms->deletable=='Y')
                       <a onClick="return ConfirmDelete();" href="{{route('cms.delete',$eachCms->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                      @endif  
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
              {!! $cms->links() !!}
              </ul>
            </div>           
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>
@endsection