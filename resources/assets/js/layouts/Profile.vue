
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
            <p>{{me.bio}}</p>
          </div>
        </div>
          <div class="timeline-nav-bar hidden-sm hidden-xs">
            <div class="row">
              <div class="col-md-3">
                <div class="profile-info profile_pic_upload">
                  <!-- <form> -->
                  <figure><img :src="getProfileUrl()" alt="Profile Image" class="img-responsive profile-photo" id="profileimage" /><Loader></Loader>
                    <div @click="clickImageChange" class="profile_img_change" v-if="$gate.allow('updateProfile', 'profile', loggedIn)"> <span class="file-input btn btn-success btn-file"> <i class="fa fa-camera"></i>
                      <!-- <input  type="file" ref="file" name="image" id="file1" class="upload" @change="changeImage();"> -->

                     <ProfileImage :profileChangeEnable="enableProfileChangePopup" @clicked="updatePopupClosed" >
                     </ProfileImage>
                      <!-- <input type="file"  name="image" id="file1" class="upload" @change="changeImage()" > -->
                      </span> 
                    </div>
                  </figure>
                  <!-- </form> -->
                  <h3>{{me.name}}</h3>
                  
                </div>
            
              </div>
              <div class="col-md-9">
                <ul class="list-inline profile-menu">
                  <li v-if="$gate.allow('viewUserDashboard', 'profile', loggedIn)"><router-link to="/dashboard">Dashboard</router-link></li>
                  <li><router-link :to="{name:'profile',params:{username:username}}">Published({{ me.blogCount}})</router-link></li>
                  <li><router-link :to="{name:'followings',params:{username:username}}">Followings({{ me.followingCount}} )</router-link></a></li>
                  <li><router-link :to="{name:'followers',params:{username:username}}">Followers({{ me.followersCount}} )</router-link></a></li>
                  <li class="lifollow" v-if="this.$route.params.username && loggedIn"><FollowButton  :following="checkFollow()" :followings="authFollowing" :Buttonclass="'float-right'" :username="this.$route.params.username" :followSuggestionHead="3"></FollowButton></li>
                </ul>
                <!-- <ul class="follow-me list-inline">
                  <li>
                    <button class="btn-primary">Edit Profile</button>
                  </li>
                </ul> -->
              </div>
            </div>
          </div>
          <!--Timeline Menu for Large Screens End--> 
          
        </div>
        <div id="page-contents">
          <div class="row">
            <div class=" col-lg-3 col-md-12 col-sm-12">
              <!-- <div id="sideba3">
              <TheDashboardSideMenu></TheDashboardSideMenu>
              </div> -->
                <div class="bio">
                <div class="row">
                  <div class="col-lg-12 col-md-6 col-sm-6"><Bio></Bio></div> 
                   <div class="col-lg-12 col-md-12 col-sm-12 h_line">
                    <hr/>
                   </div>

                  <div class="col-lg-12 col-md-6 col-sm-6"><Address></Address></div> 
                 <div class="clearfix"></div>
                </div>

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
             <div class="col-lg-9 col-md-12 col-sm-12">
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
import FollowButton from './../components/Follows/FollowButton';
import ProfileImage from './../components/Profile/ProfileImage';

    export default {

        data() {
          return {
            isLoading:false,
            initialState:{},
            enableProfileChangePopup:false,
            form:new Form({
              image:'',
              file:true,
              username:'',
              bio:'-',
              name:'',

            })
           }
        },
        mixin,
        computed:{
            me:function(){
              return this.$store.getters.me
            },
            loggedIn(){
              return this.$store.getters.user.loggedInUser;
            }, 
            authFollowing(){
              return this.$store.getters.authFollowing;
            } 
        },
        mounted(){
        },
        created(){
          this.username=this.$route.params.username;
        },
        methods:{
          checkFollow:function()
          {
            if (this.authFollowing) 
            {
              var indexval=(this.authFollowing.indexOf(this.$route.params.username));
              if(indexval==-1)
              {
                return false;
              }
              else
              {
                 return true;
              }
           }
          },
          addUserFollowed(username){
            this.authFollowing.push(username);
          },
          clickImageChange(){
            this.enableProfileChangePopup=true
          },
          updatePopupClosed(newval){
              this.enableProfileChangePopup=newval
          },
          changeImage:function() 
          {
              let curObject=this;
              const file = this.$refs.file.files[0];
              if (file.size > 5 * 1024 * 1024) {
                curObject.$store.commit('SETFLASHMESSAGE',{status:false,message:'File size is more then 5 MB'});
                return;
              }
              this.form.image = file;
              
              this.form.post('/user/changeprofile').then(response => {
                 if(response.data.status){
                   curObject.$store.commit('SETFLASHMESSAGE',{status:true,message:response.data.message});
                   curObject.$store.commit('UPDATE_PROFILE',response.data.data.imageName);
                 }
                 else{
                   curObject.$store.commit('SETFLASHMESSAGE',{status:false,message:response.data.message});
                   // curObject.$store.commit('TOGGLE_LOADING');
                 }
                }).catch(e => {
                     curObject.$store.commit('TOGGLE_LOADING');
                    if(e.status===false)
                       curObject.$store.commit('SETFLASHMESSAGE',{status:false,message:e.message});
                      else
                     curObject.$store.commit('SETFLASHMESSAGE',{status:false,message:e.message});
                });
            },
            getProfileUrl(){
                  let url=this.me.image;
                  return this.$helpers.getProfileUrl(url);
            },
             
        },
        components:{
            TheTopNav,
            TheFooter,
            TheDashboardSideMenu,
            Loader,
            Address,
            Bio,
            ProfileImage,
            FollowButton
        },

    }

</script>