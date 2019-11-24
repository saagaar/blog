@extends('layouts.common.main')
@section('content') 
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-3">
          <div class="box box-solid box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Our Team</h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{route('team.list')}}"><span class="glyphicon glyphicon-minus"></span> All teams list</a></li>
                <li class="{{ (request()->is('create/team')) ? 'active' : '' }}"><a href="{{route('team.create')}}"><span class="glyphicon glyphicon-plus"></span> Create teams</a></li>
              </ul>
            </div>
          <!-- /.box-body -->
          </div>
        </div>
        <!-- left column -->
        <div class="col-md-9">
          <!-- general form elements -->
          <div class="box ">
            <div class="box-header">
              <h3 class="box-title">Edit Team</h3>
            </div>
          <!-- Form Element sizes -->
        <div class="box ">
          <div class="box-body">
            <form action="{{route('team.edit',$team->id)}}" method="POST" enctype="multipart/form-data"> 
              @csrf            
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{$team->name}}">
                  @if ($errors->has('name'))
                  <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                  @endif
                </div>

                <div class="form-group">
                  <label for="position">Position</label>
                  <input type="text" class="form-control" name="position" id="position"placeholder="Enter Position" value="{{$team->position}}">
                  @if ($errors->has('position'))
                  <div class="alert alert-danger">{{ $errors->first('position') }}</div>
                  @endif
                </div>

                 <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control rounded-0" name="description" placeholder="Enter description" rows="6">
                  {{$team->description}}
                  </textarea>
                  @if ($errors->has('description'))
                  <div class="alert alert-danger">{{ $errors->first('description') }}</div>
                   @endif
                 </div> 

                 <div class="form-group">
                  <label for="linkedin_url">Your Linkedin URL</label>
                  <input type="text" class="form-control" name="linkedin_url" id="linkedin_url"  placeholder="Enter Your Linkedin URL" value="{{$team->linkedin_url}}">
                  @if ($errors->has('linkedin_url'))
                  <div class="alert alert-danger">{{ $errors->first('linkedin_url') }}</div>
                  @endif
                </div>

                   <div class="form-group">
                  <label for="facebook_url">Your Facebook URL</label>
                  <input type="text" class="form-control" name="facebook_url" id="facebook_url" placeholder="Enter Your Facebook URL" value="{{$team->facebook_url}}">
                  @if ($errors->has('facebook_url'))
                  <div class="alert alert-danger">{{ $errors->first('facebook_url') }}</div>
                  @endif
                </div>

                 <div class="form-group">
                  <label for="twitter_url">Your Twitter URL</label>
                  <input type="text" class="form-control" name="twitter_url" id="twitter_url" placeholder="Enter Your Twitter URL" value="{{$team->twitter_url}}">
                  @if ($errors->has('twitter_url'))
                  <div class="alert alert-danger">{{ $errors->first('twitter_url') }}</div>
                  @endif
                </div>

                <div class="form-group">
                  <label for="github_url">Your Github URL</label>
                  <input type="text" class="form-control" name="github_url" id="github_url" placeholder="Enter Github URL" value="{{$team->github_url}}">
                  @if ($errors->has('github_url'))
                  <div class="alert alert-danger">{{ $errors->first('github_url') }}</div>
                  @endif
                </div>
                 
                <div class="form-group">
                  <label for="image">Image Upload</label>
                  <input type="file" class="form-control" name="image" id="image">
                  <img src='/uploads/team-images/{{$team->image}}' width="50"/>
                  @if ($errors->has('image'))
                  <div class="alert alert-danger">{{ $errors->first('image') }}</div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="status" value="1" @if($team->status=='1') checked @endif>
                        <label class="custom-control-label" for="defaultChecked">Active</label>
                    </div>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input flat-red" name="status" value="2"@if($team->status=='2') checked @endif>
                        <label class="custom-control-label" for="defaultChecked">Inactive</label>
                    </div>
                         @if ($errors->has('status'))
                         <div class="alert alert-danger">{{ $errors->first('status') }}</div>
                         @endif
                  </div>
              </div>
              <!-- /.box-body -->
             <div class="box-footer">
                <button type="submit" class="btn btn-primary">Edit</button>
              </div>
            </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
          @endsection
      