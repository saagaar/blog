@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All language</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="{{route('language.create')}}" class="btn btn-primary">Add Language</a>
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
                  <th>Language</th>
                  <th>Short Code</th>
                  <th>Priority</th>
                  <th>Status</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th colspan="2">Action</th>
                 </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if (!$language->isEmpty())
                @foreach ($language as $lang)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{$lang->lang_name}}</td>
                  <td>{{$lang->short_code }}</td>
                  <td>{{$lang->priority }}</td>      
                 <td>
                 <input data-id="{{$lang->id}}" data-url="{{route('language.changestatus')}}" style="size: 12px;"  data-width="80" data-height="25" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive"{{$lang->status==1 ? 'checked' : '' }}>
                  </td>                                         
                  <td>{{$lang->created_at}}</td>
                  <td>{{$lang->updated_at}}</td>
                  <td><a href="{{route('language.edit',$lang->id)}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                  <td><a href="{{route('language.delete', $lang->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr> 
                @endforeach
                @else
                    <tr>
                    <td colspan="9" align="center" style="background-color: #d2d6de;"> No Languages Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $language->links()!!}
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>

@endsection