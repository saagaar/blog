@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header  with-border">
              <h3 class="box-title">SEO Management</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="{{route('seo.create')}}" class="btn btn-primary">Add Seo </a>
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
                  <th>Page Id</th>
                  <th>Page Slug</th>
                  <th>Meta key</th>
                  <th>Created at</th>
                  <th colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if(!$seo->isEmpty())
                @foreach ($seo as $eachseo)
                
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $eachseo->pageid }}</td>
                  <td>{{ $eachseo->page_slug }}</td>
                  <td>{{ $eachseo->meta_key }}</td>
                  <td>{{$eachseo->created_at}}</td>
                      
                      <td><a href="{{route('seo.edit',$eachseo->id)}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                      <td>
                       <a onClick="return ConfirmDelete();" href="{{route('seo.delete',$eachseo->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                     </td>
                </tr>
                @endforeach
                @else
                    <tr>
                    <td colspan="6" align="center" style="background-color: #d2d6de;"> No Seo Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $seo->links() !!}
              </ul>
            </div>
            
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>
@endsection