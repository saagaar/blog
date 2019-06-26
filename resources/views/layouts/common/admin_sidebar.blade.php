<aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

  <!-- Sidebar user panel (optional) -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="{{asset('admin/dist/img/avatar.png') }}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>Admin</p>
      <!-- Status -->
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>

  <!-- search form (Optional) -->
  <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search...">
      <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
    </div>
  </form>
  <!-- /.search form -->

  <!-- Sidebar Menu -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">Dashborad</li>
    <!-- Optionally, you can add icons to the links -->
    <li><a href="{{route('helpcat')}}"><i class="fa fa-folder"></i> <span>Help Category</span></a></li>
    <li><a href="{{route('adminroles')}}"><i class="fa fa-folder"></i> <span>Admin Roles</span></a></li>
    <li><a href="{{route('adminusers')}}"><i class="fa fa-folder"></i> <span>Admin Users</span></a></li>
    <!-- <li class="treeview">
      <a href="#"><i class="fa fa-folder"></i> <span>Help Category</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu">
      <li><a href="{{route('helpcat')}}"><i class="fa fa-circle-o"></i>Help Category List</a></li>
      <li><a href="{{url('create/helpcat')}}"><i class="fa fa-circle-o"></i>Create Help Category</a></li>
      </ul>
    </li> -->
    <!-- <li class="treeview">
      <a href="#"><i class="fa fa-folder"></i> <span>Admin Roles</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{url('adminrole')}}"><i class="fa fa-circle-o"></i>List All Admin Roles</a></li>
        <li><a href="{{url('\create\adminrole')}}"><i class="fa fa-circle-o"></i>Create Roles</a></li>
      </ul>
    </li> -->
  </ul>
  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>