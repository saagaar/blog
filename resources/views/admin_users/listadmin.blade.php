@extends('layouts.common.main')
@section('content') 
<div class="content-wrapper">
<section class="content-header">
      <h1>
        Admin User
        <small>Create</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
      </ol>
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
              <h3 class="box-title">All Admin Roles</h3>
              <a href="{{route('adminrole.create')}}" class="btn btn-primary">Add Roles</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @foreach ($adminroles as $adminrole)
                
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $adminrole->role_name }}</td>
                  <td>{{$adminrole->status}}</td>
                  <td>{{$adminrole->created_at}}</td>
                  <td>{{$adminrole->updated_at}}</td>
                  <td>
                  <ul class="list-inline">
                      <li><a href="{{route('adminrole.edit', $adminrole->id)}}" class="btn btn-primary">Edit</a></li>
                      <li><form action="{{route('adminrole.delete', $adminrole->id)}}" method="post">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                    </form></li>
                  </ul>
                  
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            {!! $adminroles->links() !!}
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>
</div>
@endsection