@extends('layouts.common.main')
@section('content') 
<section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              @if($account->image)
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/user-images/'.$account['image']) }}" alt="User profile picture">
              @else
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/default-profile-icon-24.jpg/') }}" alt="User profile picture">
             @endif

              <h3 class="profile-username text-center">{{$account->name}}</h3>

              <p class="text-muted text-center">@foreach ($account->roles()->pluck('name') as $role)
                  <span class="label label-info label-many">{{ $role }}</span>
              @endforeach</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Followers</b> <a class="pull-right">{{$account->followers_count}}</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="pull-right">{{$account->followings_count}}</a>
                </li>
                <!-- <li class="list-group-item">
                  <b>Friends</b> <a class="pull-right">13,287</a>
                </li> -->
              </ul>
              <p class="text-muted text-center">
                 <a href="{{route('account.edit',$account->id)}}"> <span class="label label-default label-many">Edit Profile</span></a>
              <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Phone</strong>

              <p class="text-muted">
                {{$account->phone }}
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>

              <p class="text-muted">{{$account->address }},@foreach ($account->country()->pluck('country') as $country)
                  {{ $country }}
              @endforeach</p>

              <hr>

              <strong><i class="fa fa-info-circle margin-r-5"></i> Status</strong>
              <p class="text-muted">
                    @if($account->status=='1')
                    <span class="label label-success">Active</span>
                    @elseif ($account->status=='2')
                    <span class="label label-danger">Inactive</span>
                    @elseif ($account->status=='3')
                    <span class="label label-warning">Closed</span>
                    @elseif ($account->status=='4')
                    <span class="label label-default">Suspended</span>
                    @endif</p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Bio</strong>

              <p>{{$account->bio}}</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Published Articles ({{ $timeline->total()}})</a></li>
              <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
              <li><a href="#transactions" data-toggle="tab">Transaction</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                @if($timeline)
                @foreach($timeline as $eachPost)
                <div class="post">
                  <div class="user-block">
                    @if($eachPost->image)
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/blog/'.$eachPost->code.'/'.$eachPost->image) }}" alt="Blog image">
                    @else
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('uploads/default-profile-icon-24.jpg/') }}" alt="User profile picture">
                    @endif
                        <span class="username">
                          <a href="#">{{$eachPost->title}}</a>
                          <a href="{{route('blog.edit',[ $eachPost->id,str_slug($eachPost->title)])}}" class="pull-right btn-box-tool"><i class="fa fa-edit"></i></a>
                        </span>
                         <span class="description">{{ $eachPost->created_at->diffForHumans() }}</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    {{ str_limit($eachPost['short_description'], $limit = 150, $end = '...') }}
                  </p>
                  <ul class="list-inline">
                    <!-- <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li> -->
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i>{{$eachPost['likes_count']}} Appreciate</a>
                    </li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-eye margin-r-5"></i>{{$eachPost['views']}} Views</a>
                    </li>
                    <li class="pull-right">
                      <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                        ({{$eachPost['comments_count']}})</a>
                    </li>
                  </ul>

                  <!-- <input class="form-control input-sm" type="text" placeholder="Type a comment"> -->
                </div>
                @endforeach
                @else
                <div class="post">
                  <p class="text-center">
                    <b>No Post in timeline</b>
                  </p>
                  <!-- <input class="form-control input-sm" type="text" placeholder="Type a comment"> -->
                </div>
                @endif
                <!-- /.post -->
                    <div class="box-footer clearfix">
                      <ul class="pagination pagination-sm no-margin pull-right">
                      {!! $timeline->links() !!}
                      </ul>
                    </div>
               
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <!-- <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                  </li> -->
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  @if($notification)
                  @foreach($notification as $eachNotification)
                  <li>
                    <i class="fa fa-bell-o bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i>{{$eachNotification->created_at->diffForHumans()}}</span>

                      <h3 class="timeline-header">{!! $eachNotification->data['message'] !!}</h3>

                    </div>
                  </li>
                  @endforeach
                  @endif
                 
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->
               <div class=" tab-pane" id="transactions">
                 <table id="example2" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Reference</th>
                  <th>Amount</th>
                  <th>Debit /Credit</th>
                  <th>Remarks</th>
                  <th>Created at</th>
                 </tr>
                </thead>
                <tbody>
                <?php  $i = 0; ?>
                @if (!$transaction->isEmpty())
                @foreach ($transaction as $data)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>
                   {{$data->reference}}
                  </td>
                  <td>{{$data->amount}}</td>   
                  <td>{{$data->debit_credit}}</td>   
                   <td>
                      {{$data->remarks}}
                   </td>                                        
                  <td>{{$data->created_at->diffforhumans()}}</td>
                 
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

              <div class="tab-pane" id="settings">
                <form class="form-horizontal" action="{{ route('account.edit' , $account->id)}}" method="POST"  enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{$account->name}}" >
                @if ($errors->has('name'))
                <div class="active">{{ $errors->first('name') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" name="email" id="email" value="{{$account->email}}">
                @if ($errors->has('email'))
                <div class="active">{{ $errors->first('email') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                @if ($errors->has('password'))
                <div class="active">{{ $errors->first('password') }}</div>
                @endif
                </div>
                <div class="form-group">
                  <label for="password_confirmation">Password Confirmation</label>
                  <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Enter password again">
                </div>
                <div class="form-group">
                  <label for="roles" class="control-label">Roles</label>
                  <!-- value="{{ $roles }}" -->
                    <select multiple="multiple" class="form-control js-example-basic-multiple"  name="roles[]" id="roles">
                      @if($account->roles()->pluck('name'))
                           @foreach ($account->roles()->get() as $rol)
                                        <option value="{{ $rol->id }}"selected>{{ $rol->name }}</option>
                                    @endforeach
                    @endif
                      @foreach ($roles as $values)
                      <option value="{{ $values->id }}"> {{ $values->name }}  </option>
                      @endforeach
                      
                    </select>
                    <p class="help-block"></p>
                    @if($errors->has('roles'))
                        <p class="help-block">
                            {{ $errors->first('roles') }}
                        </p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="phone">Phone number</label>
                    <input type="text" class="form-control" name="phone" value="{{$account->phone}}" id="phone" placeholder="Phone Number">
                    @if ($errors->has('phone'))
                  <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                  @endif
                  </div>

                  <div class="form-group">
                  <label for="is_login">Is Login:</label>
                  <label><input type="radio" name="is_login" value="1" {{ $account->is_login == '1' ? 'checked' : ''}} checked>Active</label>
                  <label><input type="radio" name="is_login" value="2" {{ $account->is_login == '2' ? 'checked' : ''}}>Inactive</label>
                    @if ($errors->has('is_login'))
                    <div class="alert alert-danger">{{ $errors->first('is_login') }}</div>
                    @endif
                    </div>                
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" value="{{$account->address}}" id="address"  placeholder="Enter Address">
                    @if ($errors->has('address'))
                  <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                  @endif
                  </div>
                   <div class="form-group">
                     <label for="Country">Country</label>
                    <select name="country" class="form-control">
                      @if($account->country)
                       @foreach ($account->country()->get() as $country)
                                        <option value="{{ $country->id }}">{{ $country->country }}</option>
                                    @endforeach
                        @else
                    <option value="">--Select--</option>
                    @endif
                    @foreach ($countries as $country)
                    
                      <option value="{{$country->id}}">{{$country->country}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('country'))
                  <div class="alert alert-danger">{{ $errors->first('country') }}</div>
                  @endif
                  </div>
                  <div class="form-group">
                <label>Date Of Birth:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" value="{{$account->dob}}" name="dob" class="form-control pull-right" id="datepicker">

                </div>
                @if ($errors->has('dob'))
                  <div class="alert alert-danger">{{ $errors->first('dob') }}</div>
                  @endif
                <!-- /.input group -->
              </div>
                  <div class="form-group">
                  <label for="image">Profile Picture</label>
                    <div class="text-left">
                      @if($account->image)
                      <img src="{{ asset('uploads/user-images/'.$account->image) }}" class="avatar img-circle" alt="Profile Picture" height="90" width="90">
                     @else
                       <img src="{{asset('uploads/default-profile-icon-24.jpg') }}" class="avatar img-circle" alt="Profile Picture" height="90" width="90">   
                      @endif
                      <h6>Upload a different photo...</h6>
                      <input type="file" class="form-control" name="image" id="image">
                    </div>
                  
                  @if ($errors->has('image'))
                <div class="alert alert-danger">{{ $errors->first('image') }}</div>
                @endif
                </div>
              </div>
              <div class="form-group">
                  <label for="status">Status: </label>
                  <label><input type="radio" name="status" value="1" {{ $account->status == '1' ? 'checked' : ''}}>Active</label>
                  <label><input type="radio" name="status" value="2" {{ $account->status == '2' ? 'checked' : ''}}>Inactive</label>
                  <label><input type="radio" name="status" value="3" {{ $account->status == '3' ? 'checked' : ''}}>Closed</label>
                  <label><input type="radio" name="status" value="4" {{ $account->status == '4' ? 'checked' : ''}}>Suspended</label>
                </div>
                @if ($errors->has('status'))
                <div class="active">{{ $errors->first('status') }}</div>
                @endif
                <div class="box-footer">
                <button type="submit" class="btn btn-primary">Edit</button>
              </div>
              </div>
              <!-- /.box-body -->

              
            </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
@endsection