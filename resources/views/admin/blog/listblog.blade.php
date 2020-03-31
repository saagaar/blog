@extends('layouts.common.main')
@section('content') 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Blogs</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="{{route('blog.create')}}" class="btn btn-primary">Add Blogs</a>
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
                  <th>id</th>
                  <th>Title</th>
                  <th width="20%">Short description</th>
                  <th>Save/Publish</th>
                  <th>Featured </th>
                  <th>Show in Home </th>
                  <th>Published By</th>   
                  <th>Image</th>
                  <th colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php  $i = 0; 

                ?>
                @if (!$blogs->isEmpty())
                @foreach ($blogs as $eachblog)


                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $eachblog->title }}</td>
                  <td>{{strip_tags($eachblog->short_description) }}</td>
                  <td>
                   <input data-id="{{$eachblog->id}}" data-url="{{route('blog.changemethod')}}" style="size: 12px;" data-width="80" data-height="25" class="toggle-class" name="save_method" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Publish" data-off="Draft"{{$eachblog->save_method==2 ? 'checked' : '' }}>
                  </td> 
                  <td> 
                    <input data-id="{{$eachblog->id}}" data-url="{{route('blog.updateBlogIsFeatured')}}" style="size: 12px;" data-width="80" data-height="25" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="On" data-off="Off"{{$eachblog->featured==1 ? 'checked' : '' }}>
                  </td>
                  <td>
                     <input data-id="{{$eachblog->id}}" data-url="{{route('blog.updateShowInHome')}}" style="size: 12px;" data-width="80" data-height="25" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Yes" data-off="No"{{$eachblog->show_in_home==1 ? 'checked' : '' }}>
                  </td>
                  <td>
                     <a href="/admin/view/account/{{$eachblog['user']['id']}}">{{ ($eachblog['user']['name']) }}
                  </td>
                   <td><img src="{{ asset('uploads/blog/'.$eachblog->code.'/'.$eachblog->image) }}" alt="Blog Image" height="42" width="42"></td>
                

                  <td><a href="{{route('blog.edit',[ $eachblog->id,str_slug($eachblog->title)])}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>

                  <td><a onClick="return ConfirmDelete();" href="{{route('blog.delete', $eachblog->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
                @endforeach
                @else
                    <tr>
                    <td colspan="9" align="center" style="background-color: #d2d6de;"> No Blogs Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $blogs->links() !!}
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>

@endsection