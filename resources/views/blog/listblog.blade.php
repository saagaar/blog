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
                  <th>Content</th>
                  <th>Save/Publish</th>
                  <th>Image</th>
                  <th>Language Name</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if (!$blogs->isEmpty())
                @foreach ($blogs as $eachblog)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $eachblog->title }}</td>
                   <td>{{strip_tags($eachblog->content) }}</td>
                  <td>
                      @if ($eachblog->save_method == '1')
                        <span class="label label-danger">Draft</span>
                      @else
                        <span class="label label-success">Published</span>
                      @endif
                  </td>
                  <td><img src="{{ asset('images/blogimages/'.$eachblog['image']) }}" alt="Blog Image" height="42" width="42"></td>
                  <td>
                     @foreach ($eachblog->Locales()->pluck('lang_name') as $role)
                                        <span class="label label-info label-many">{{ $role }}</span>
                                    @endforeach
                  </td>
                  <td>{{$eachblog->created_at}}</td>
                  <td>{{$eachblog->updated_at}}</td>
                  <td><a href="{{route('blog.edit',[ $eachblog->id,str_slug($eachblog->title)])}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                  <td><a href="{{route('blog.delete', $eachblog->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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