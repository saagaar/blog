
<template>
<div>
<TopNav></TopNav>
<div class="mid_part" >
<!--================Dashboard =================-->
  <section class="dashboard_sec">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3">
               
            <div id="sidebar">      
            <div class="profile-card">
                <img src="images/p_image.png" alt="user" class="profile-photo">
                <h5><a href="timeline.html" class="text-white">Shanvi Bhandari</a></h5>
                <a href="#" class="text-white"><i class="ion ion-android-person-add"></i> 1,299 followers</a>
            </div>
            <ul class="nav-news-feed">
              <li>
                  <i class="fa fa-newspaper"></i>
                  <div><router-link to="/">Reports</router-link></div>
              </li>
              <li>
                  <i class="fa fa-list-ol"></i>
                  <div>
                  <router-link to="/blog/list">List Blog</router-link>
                 </div>
              </li>
               <li>
                  <i class="fa fa-list-ul"></i>
                  <div>
                     <router-link to="/blog/add">Add Blog</router-link>
                  </div>
              </li>
              <li>
                  <i class="fa fa-list-ul"></i>
                  <div>
                     <router-link to="/profile">Profile</router-link>
                  </div>
              </li>
              <li>
                  <i class="fa fa-list-ul"></i>
                  <div>
                     <router-link to="/categories">Customize Interests</router-link>
                  </div>
              </li>
              <li>
                  <i class="fa fa-list-ul"></i>
                  <div><a href="#">No of post <span>420</span></a></div>
              </li>
              <li>
                  <i class="fa fa-user-plus"></i>
                  <div><a href="#">Who's viewed your profile <span>14</span></a></div>
              </li>
            </ul>
          </div>
            </div>
           <router-view></router-view>
            <div class="clearfix"></div>

        </div>
    </div>
  </section>
  <!--================Dashboard Area =================-->
 
</div>
<Footer></Footer>
</div>
</template>
<script>
import TopNav from './../components/TopNav/TopNav';
import Footer from './../components/Footer/blogFooter';
    export default {
        mounted() {
            // console.log('Component mounted.')
        },
        components:{
            TopNav,
            Footer
        },
    }
</script>