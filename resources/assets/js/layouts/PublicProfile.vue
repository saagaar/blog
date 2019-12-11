
<template>
<div>
<TheTopNav></TheTopNav>
<div class="mid_part" >
  <section class="dashboard_sec">
    <div class="container">
         <div class="timeline">
        <div class="timeline-cover"> 
          
        <div class="timeline-quote">
          <div class="collen">
            <p>  {{ bio }}</p>
          </div>
        </div>
          <div class="timeline-nav-bar hidden-sm hidden-xs">
            <div class="row">
              <div class="col-md-3">
                <div class="profile-info profile_pic_upload">
                  <form>
                  <figure><img :src="getProfileUrl()" alt="Profile Image" class="img-responsive profile-photo" id="profileimage" /><Loader></Loader>
                    <!-- <div class="profile_img_change"> <span class="file-input btn btn-success btn-file"> <i class="fa fa-camera"></i>
                      <input type="file" ref="file" name="image" id="file1" class="upload" @change="changeImage();">
                      </span> </div> -->
                  </figure>
                  </form>
                  <h3>{{ name }}</h3>
                </div>
            
              </div>
              <div class="col-md-9">
                <ul class="list-inline profile-menu">
                  <li><router-link to="/dashboard">Dashboard</router-link></li>
                  <li><router-link :to="'/profile/'+username">Timeline</router-link></li>
                  
                  <li><router-link :to="'/followings/'+username">Followings({{ followings_count }} )</router-link></a></li>
                  <li><router-link :to="'/followers/'+username">Followers({{ followers_count }} )</router-link></a></li>
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
             <!--  <div id="sideba3">
                <TheDashboardSideMenu></TheDashboardSideMenu>
              </div>  -->
               <div class="bio">
                <Bio></Bio>
                <hr/>
                <Address></Address>
                 </div> 
              <!-- <div id="chat-block" class="" style="">
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
              </div> -->
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
import Address from './../components/Profile/Address';
import Bio from './../components/Profile/Bio';
import Loader from './../components/Loader';
import Form from './../services/Form.js';
    export default {
    	 mixins:[mixin],
        data(){
          return {
            isLoading:false,
            initialState:{},
            image:'',
            username:'',
            followers_count:0,
            followings_count:0,
            bio:'-',
            name:'-'
           }
        },
        watch: {
          initialState: function () {
            this.bio=this.initialState.userdata.bio;
            this.image=this.initialState.userdata.image;
            this.username=this.initialState.userdata.username;
            this.name=this.initialState.userdata.name;
            this.followers_count=this.initialState.userdata.followers_count;
            this.followings_count=this.initialState.userdata.followings_count;
            this.name=this.initialState.userdata.name;
          },
        },
        methods:{
            getProfileUrl(){
              return this.$helpers.getProfileUrl(this.image);
            }
        },
        components:{
            TheTopNav,
            TheFooter,
            TheDashboardSideMenu,
            Loader,
            Address,
            Bio
        },

    }

</script>