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
    <li @if($primary_menu=="dashboard.list") class="header" @endif>Dashboard</li>
    <!-- Optionally, you can add icons to the links -->
     <li @if($primary_menu=="siteoption.list") class="active" @endif><a href="{{route('sitesetting')}}"><i class="fa  fa-gear"></i> <span>Site setting</span></a></li>
    <li class="treeview">
      <a href=""><i class="fa fa-user-plus"></i> <span>User Account</span>
      <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
      </span>
      </a>
          <ul class="treeview-menu">
            <li @if($primary_menu=="account.list") class="active" @endif><a href="{{route('account.list')}}"><i class="fa  fa-paint-brush"></i>Accounts</a></li>
            <li @if($primary_menu=="role.list") class="active" @endif><a href="{{route('roles.list')}}"><i class="fa fa-group"></i> User Roles</a></li>
            <li @if($primary_menu=="permission.list") class="active" @endif><a href="{{route('permission.list')}}"><i class="glyphicon glyphicon-lock"></i> User Permissions</a></li>
          </ul>
      </li>
      <li @if($primary_menu=="cms.list") class="active" @endif><a href="{{route('cms.list')}}"><i class="fa fa-chain"  aria-hidden="true"></i> <span>CMS</span></a>
        <li  @if($primary_menu=="testimonial.list") class="active" @endif><a href="{{route('testimonial.list')}}"><i class="fa fa-users"  aria-hidden="true"></i> <span>Testimonial</span></a>
        <li  @if($primary_menu=="services.list") class="active" @endif><a href="{{route('services.list')}}"><i class=" fa fa-wrench"  aria-hidden="true"></i> <span>Services</span></a>
        <li @if($primary_menu=="banner.list") class="active" @endif><a href="{{route('banner.list')}}"><i class="fa fa-bookmark-o "  aria-hidden="true"></i> <span>Banner</span></a>
        <li  @if($primary_menu=="team.list") class="active" @endif><a href="{{route('team.list')}}"><i class="fa fa-group"  aria-hidden="true"></i> <span>Team</span></a>   
         <li @if($primary_menu=="subscription.list" ) class="active" @endif><a href="{{route('subscription.list')}}"><i class="fa fa-flag-checkered"  aria-hidden="true"></i> <span>Subscription Manager</span></a>   
        <li @if($primary_menu=="paymentgateway.list" ) class="active" @endif><a href="{{route('paymentgateway.list')}}"><i class="fa  fa-credit-card"  aria-hidden="true"></i> <span>Payment Gateway</span></a> 
        <li @if($primary_menu=="client.list") class="active" @endif><a href="{{route('client.list')}}"><i class="fa fa-user"  aria-hidden="true"></i> <span>Client</span></a>   
         <li @if($primary_menu=="seo.list") class="active" @endif><a href="{{route('seo.list')}}"><i class="fa fa-eye"  aria-hidden="true"></i> <span>SEO</span></a> 
          <li @if($primary_menu=="language.list") class="active" @endif><a href="{{route('language.list')}}"><i class="fa fa-language"  aria-hidden="true"></i> <span>Language</span></a>     
    
    <li class="treeview">
      <a href=""><i class="fa  fa-pencil-square"></i> <span>Blog</span>
      <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
      </span>
      </a>
          <ul class="treeview-menu">
            <li @if($primary_menu=="category.list") class="active" @endif><a href="{{route('adminblogcategory.list')}}"><i class="fa  fa-paint-brush"></i> Blog Category</a></li>
            <li  @if($primary_menu=="blog.list") class="active" @endif><a href="{{route('blog.list')}}"><i class="fa fa-info-circle"></i> Blog</a></li>
            <li  @if($primary_menu=="tag.list") class="active" @endif><a href="{{route('tags.list')}}"><i class="fa fa-hashtag"></i> <span>Tags</span></a>
         
          </ul>
      </li>
   <li  class="treeview">
      <a href=""><i class="fa fa-image"></i> <span>Gallery</span>
      <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
      </span>
      </a>
          <ul class="treeview-menu">
            <li  @if($primary_menu=="gallerycat.list") class="active" @endif><a href="{{route('gallerycategory.list')}}"><i class="fa fa-folder"></i> Gallery Category</a></li>
            <li  @if($primary_menu=="gallery.list") class="active" @endif><a href="{{route('gallery.list')}}"><i class="fa fa-image"></i> Gallery</a></li>
         
          </ul>
      </li>
     <li class="treeview">
    <a href="#"><i class="fa  fa-question-circle"></i>Help <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span></a>
      <ul class="treeview-menu">
            <li  @if($primary_menu=="helpcat.list") class="active" @endif><a href="{{route('helpcat.list')}}"><i class="fa fa-info-circle"></i> Help Category</a></li>
            <li><a href="#"><i class="fa  fa-question "></i> Help Story</a></li>
         
          </ul>
    </li>
     <li  @if($primary_menu=="contact.list") class="active" @endif><a href="{{route('contact.list')}}"><i class="fa fa-phone"></i> <span>Contact Us</span></a>
    <li @if($primary_menu=="websitelog.list") class="active" @endif><a href="{{route('websitelog.list')}}"><i class="fa fa-history"></i> <span>Website Logs</span></a>
    <li @if($primary_menu=="blocklist.list") class="active" @endif><a href="{{route('blocklist.list')}}"><i class="fa fa-server"></i> <span>IP Block List</span></a>   
    </li>
     <li @if($primary_menu=="seo.list") class="active" @endif><a href="{{route('seo.list')}}"><i class="fa fa-search"></i> <span>Seo Management</span></a>   
    </li>

  </ul>
  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>