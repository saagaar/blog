@extends('layouts.common.main')
@section('content') 

<div class="content-wrapper">
<section class="content-header">
      <h1>
        Help Category
      </h1>
      @include('includes.breadcrumbs', ['breadcrumbs' => [
    'Dashboard' => route('admin.dashboard'),
    'Blog Category',
      ]])
    </section>
@if(Session::has('success'))
<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">x</button>
						<strong>Success! </strong>{!!session('success')!!}
				</div>
				@endif
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Blog Category</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="{{route('helpcat.create')}}" class="btn btn-primary">Add Blog Category</a>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Name</th>
                  <th>Display</th>
                  <th>slug</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if (!$categorys->isEmpty())
                @foreach ($categorys as $category)
                
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $category->name }}</td>
                  <td>
                      @if ($category->display == 'Y')
                        <span class="label label-success">Yes</span>
                      @else
                        <span class="label label-danger">No</span>
                      @endif
                  </td>
                  <td>{{$category->slug}}</td>
                  <td>{{$category->created_at}}</td>
                  <td>{{$category->updated_at}}</td>
                  <td><a href="{{route('Blogcat.edit', $category->id)}}"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a></td>
                  <td><a href="{{route('helpcat.delete', $category->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
                @endforeach
                @else
                    <tr>
                    <td colspan="6" align="center" style="background-color: #d2d6de;"> No Blog Category Found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $categorys->links() !!}
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>
</div>
@endsection