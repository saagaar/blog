
<template>
<div>
<TopNav></TopNav>
<MainNav></MainNav>
   <vcl-instagram v-if="!myData"></vcl-instagram>
    <section class="dashboard_sec">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3">
               
            <div id="sidebar">      
            <div class="profile-card">
                <img src="img/p_image.png" alt="user" class="profile-photo">
                <h5><a href="timeline.html" class="text-white">Shanvi Bhandari</a></h5>
                <a href="#" class="text-white"><i class="ion ion-android-person-add"></i> 1,299 followers</a>
            </div>

            <ul class="nav-news-feed">
              <li><i class="fa fa-newspaper"></i>
                <div><a href="#">My Newsfeed <span></span></a></div>
            </li>
              <li><i class="fa fa-list-ol"></i>
                <div><a href="#">Following <span>143</span></a></div>
            </li>
              <li><i class="fa fa-list-ul"></i>
                <div><a href="#">No of post <span>420</span></a></div>
            </li>
              <li><i class="fa fa-user-plus"></i>
                <div><a href="#">Who's viewed your profile <span>14</span></a></div>
            </li>
            </ul>

        </div>
                
</div>

<div class="col-md-9 col-sm-9">
    <div id="main">
        <div class="white-box edit_profile">
            <div class="area-heading">
                <h3>Change Password</h3>
            </div>

            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate</p>

            <form class="form-contact contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
<div class="row">

<div class="col-sm-12 form-group">
<label>Old Password</label>
<input class="form-control" name="oldPassword" id="oldPassword" type="text"/>
</div>
<div class="col-sm-6 form-group">
<label>New Password</label>
<input class="form-control" name="newPassword" id="newPassword" type="text"/>
</div>
<div class="col-sm-6 form-group">
<label>Confirm Password</label>
<input class="form-control" name="confirmPassword" id="confirmPassword" type="email"/>
</div>

</div>

<div class="form-group mt-3">
<button type="submit" class="btn btn-primary btn-round text-uppercase">Save Change</button>
</div>
</form>

        </div>
    </div>
</div>

<div class="clearfix"></div>
        </div>
    </div>
</section>
</div>
</template>

<script>
  import { VclFacebook,VclInstagram } from 'vue-content-loading';
import TopNav from './../components/TopNav/TopNav';
import MainNav from './../components/MainNav/MainNav';
import blogFooter from './../components/Footer/blogFooter';
    export default {
         data() {
    return {
          myData: null
        }
      },
        mounted() {
             setTimeout(() => {
              this.myData = 'Example Data';
            }, 5000);
        },

        components:{
            TopNav,
            MainNav,
            blogFooter,
            VclFacebook,
            VclInstagram
          
        },
    }
</script>