
<template>
<div>
<TheTopNav></TheTopNav>
<div class="mid_part" >

  <section class="dashboard_sec">
    <div class="container">
         <div class="timeline">
        <div class="timeline-cover"> 
          
          <div class="timeline-nav-bar hidden-sm hidden-xs">
            <div class="row">
              <div class="col-md-3">
                <div class="profile-info profile_pic_upload">
                  <figure><img src="images/user-6.jpg" alt="Profile Image" class="img-responsive profile-photo" id="profileImage" />
                    <div class="profile_img_change"> <span class="file-input btn btn-success btn-file"> <i class="fa fa-camera"></i>
                      <input type="file"  name="file" id="file1" class="upload" onchange="viewimage(event)" multiple>
                      </span> </div>
                  </figure>
                  <h3>Bikash Bhandari</h3>
                </div>
            
              </div>
              <div class="col-md-9">
                <ul class="list-inline profile-menu">
                  <li><router-link to="/profile">Timeline</router-link></li>
                  
                  <li><router-link to="/followings">Followings({{ me.followingCount}} )</router-link></a></li>
                  <li><router-link to="/followers">Followers({{ me.followersCount}} )</router-link></a></li>
                </ul>
                <ul class="follow-me list-inline">
                  <li>
                    <!-- <button class="btn-primary">Edit Profile</button> -->
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!--Timeline Menu for Large Screens End--> 
          
        </div>
        <div id="page-contents">
          <div class="row">
            <div class="col-md-3 col-sm-3">
              <!-- <div id="sideba3">
              <TheDashboardSideMenu></TheDashboardSideMenu>
              </div> -->
                <div class="bio">
                <h4><i class="fa fa-info-circle">&nbsp;</i> Info</h4>
                <p class="text-center">Add a short bio to tell people more about yourself.</p>
                <a href="#" class="text-center" data-toggle="modal" data-target="#bioModal"> Edit Bio</a>
                <hr/>
                <h4><i class="fa fa-map-marked">&nbsp;</i> Address</h4>
                <p class="text-center"> Gokarneshwor Nagarpalika -3, Kathmandu Nepal,</p>
                <a href="#" class="text-center" data-toggle="modal" data-target="#addressModal"> Edit Address</a> </div>
              <div id="chat-block" class="" style="">
                <div class="title">Chat online</div>
                <ul class="online-users list-inline">
                  <li><a href="#" title="Sagar Chapagain"><img src="/images/user-2.jpg" alt="user" class="img-responsive profile-photo"><span class="online-dot"></span></a></li>
                  <li><a href="#" title="Shanvi Bhandari"><img src="images/user-3.jpg" alt="user" class="img-responsive profile-photo"><span class="online-dot"></span></a></li>
                  <li><a href="#" title="Sangita Bhandari"><img src="images/user-4.jpg" alt="user" class="img-responsive profile-photo"><span class="online-dot"></span></a></li>
                  <li><a href="#" title="Sirjana Panta"><img src="images/user-5.jpg" alt="user" class="img-responsive profile-photo"><span class="online-dot"></span></a></li>
                  <li><a href="#" title="Bikash Bhandari"><img src="images/user-6.jpg" alt="user" class="img-responsive profile-photo"><span class="online-dot"></span></a></li>
                  <li><a href="#" title="Robert Cook"><img src="images/user-7.jpg" alt="user" class="img-responsive profile-photo"><span class="online-dot"></span></a></li>
                  <li><a href="#" title="Richard Bell"><img src="images/user-8.jpg" alt="user" class="img-responsive profile-photo"><span class="online-dot"></span></a></li>
                  <li><a href="#" title="Anu Khatri"><img src="images/user-9.jpg" alt="user" class="img-responsive profile-photo"><span class="online-dot"></span></a></li>
                  <li><a href="#" title="Pratima Kuinkel"><img src="images/user-1.jpg" alt="user" class="img-responsive profile-photo"><span class="online-dot"></span></a></li>
                </ul>
              </div>
            </div>
             <div class="col-md-9 col-sm-9">
               <router-view></router-view>
             </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  <!--================Dashboard Area =================-->
 
</div>
<TheFooter></TheFooter>
</div>
</template>
<script>
import mixin  from './../mixins/LoadData.mixin.js';
import TheTopNav from './../components/TopNav/TheTopNav';
import TheDashboardSideMenu from './../components/Dashboard/TheDashboardSideMenu';
import TheFooter from './../components/Footer/TheFooter';
    export default {
        data() {
          return {
           
           }
        },
        // name:UserDashboard,
        mixin,
        computed:{
            me:function(){
              return this.$store.getters.me
            },
            
           
        },
        components:{
            TheTopNav,
            TheFooter,
            TheDashboardSideMenu
        }
    }


     function viewimage(event) {
                          
                          var reader = new FileReader();
                          var imageField = document.getElementById("profileImage")
                          reader.onload = function () {
                              if (reader.readyState == 2) {
                                  imageField.src = reader.result;
                              }
                          }
                          reader.readAsDataURL(event.target.files[0]);
                      }



</script>