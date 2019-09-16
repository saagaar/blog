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
    <li class="header">Dashboard</li>
    <!-- Optionally, you can add icons to the links -->
     <li><a href="{{route('sitesetting')}}"><i class="fa  fa-gear"></i> <span>Site setting</span></a></li>
    <li class="treeview">
      <a href=""><i class="fa fa-user-plus"></i> <span>User Account</span>
      <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
      </span>
      </a>
          <ul class="treeview-menu">
            <li><a href="{{route('account.list')}}"><i class="fa  fa-paint-brush"></i>Accounts</a></li>
            <li><a href="{{route('roles.list')}}"><i class="fa fa-group"></i> User Roles</a></li>
            <li><a href="{{route('permission.list')}}"><i class="glyphicon glyphicon-lock"></i> User Permissions</a></li>
          </ul>
      </li>
      <li><a href="{{route('cms.list')}}"><i class="fa fa-font-awesome"  aria-hidden="true"></i> <span>CMS</span></a>
        <li><a href="{{route('testimonial.list')}}"><i class="fa  fa-users"  aria-hidden="true"></i> <span>Testimonial</span></a>
        <li><a href="{{route('services.list')}}"><i class=" fa fa-phone-square"  aria-hidden="true"></i> <span>Services</span></a>
        <li><a href="{{route('banner.list')}}"><i class="fa fa-bookmark-o "  aria-hidden="true"></i> <span>Banner</span></a>
        <li><a href="{{route('team.list')}}"><i class="fa fa-group"  aria-hidden="true"></i> <span>Team</span></a>   
         <li><a href="{{route('subscription.list')}}"><i class="fa fa-flag-checkered"  aria-hidden="true"></i> <span>Subscription Manager</span></a>   
        <li><a href="{{route('paymentgateway.list')}}"><i class="fa  fa-credit-card"  aria-hidden="true"></i> <span>Payment Gateway</span></a> 
        <li><a href="{{route('client.list')}}"><i class="fa fa-user"  aria-hidden="true"></i> <span>Client</span></a>   
         <li><a href="{{route('seo.list')}}"><i class="fa fa-eye"  aria-hidden="true"></i> <span>SEO</span></a> 
          <li><a href="{{route('language.list')}}"><i class="fa fa-globe"  aria-hidden="true"></i> <span>Language</span></a>     
    
    <li class="treeview">
      <a href=""><i class="fa  fa-pencil-square"></i> <span>Blog</span>
      <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
      </span>
      </a>
          <ul class="treeview-menu">
            <li><a href="{{route('adminblogcategory.list')}}"><i class="fa  fa-paint-brush"></i> Blog Category</a></li>
            <li><a href="{{route('blog.list')}}"><i class="fa fa-info-circle"></i> Blog</a></li>
            <li><a href="{{route('tags.list')}}"><i class="fa fa-hashtag"></i> <span>Tags</span></a>
         
          </ul>
      </li>
   <li class="treeview">
      <a href=""><i class="fa  fa-image"></i> <span>Gallery</span>
      <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
      </span>
      </a>
          <ul class="treeview-menu">
            <li><a href="{{route('gallerycategory.list')}}"><i class="fa  fa-paint-brush"></i> Gallery Category</a></li>
            <li><a href="{{route('gallery.list')}}"><i class="fa fa-info-circle"></i> Gallery</a></li>
         
          </ul>
      </li>
     <li class="treeview">
    <a href="#"><i class="fa  fa-question-circle"></i>Help <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span></a>
      <ul class="treeview-menu">
            <li><a href="{{route('helpcat.list')}}"><i class="fa fa-info-circle"></i> Help Category</a></li>
            <li><a href="#"><i class="fa  fa-question "></i> Help Story</a></li>
         
          </ul>
    </li>
     <li><a href="{{route('contact.list')}}"><i class="fa fa-phone"></i> <span>Contact Us</span></a>
    <li><a href="{{route('websitelog.list')}}"><i class="fa fa-history"></i> <span>Website Logs</span></a>
    <li><a href="{{route('blocklist.list')}}"><i class="fa fa-server"></i> <span>IP Block List</span></a>   
    </li>
     <li><a href="{{route('seo.list')}}"><i class="fa fa-search"></i> <span>Seo Management</span></a>   
    </li>

  </ul>
  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>