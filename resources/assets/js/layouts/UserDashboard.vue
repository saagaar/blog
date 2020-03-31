
<template>
<div>
<TheTopNav></TheTopNav>
<div class="mid_part" >
<!--================Dashboard =================-->

  <section class="dashboard_sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5 col-sm-12 profile_left">
            <SuccessErrorMessage></SuccessErrorMessage>
            <div id="sidebar">      
            <div class="profile-card">
                <img :src="getProfileUrl()" :alt="loggedInUser.name" class="profile-photo">
                <h5><router-link to="/profile"  class="text-white">{{ loggedInUser.name}}</router-link></h5>
                  <h6><router-link to="/followers" class="text-white">{{ me.followersCount}} followers</router-link>
                  <router-link to="/followings" class="text-white">{{ me.followingCount}} following</router-link></h6>
                <!-- <a href="#" class="text-white"><i class="ion ion-android-person-add"></i> {{ me.followersCount}} followers &nbsp;{{ me.followingCount}} following</a> -->

            </div>
            <TheDashboardSideMenu></TheDashboardSideMenu>
          </div>
            </div>
            
           <router-view></router-view>
            <div class="clearfix"></div>

        </div>
    </div>
  </section>
  <!--================Dashboard Area =================-->
 
</div>
<TheFooter></TheFooter>
</div>
</template>
<script>
import SuccessErrorMessage from './../components/SuccessErrorMessage.vue';

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
             loggedInUser:function(){
              return this.$store.getters.user.loggedInUser
            },
        },
        

        components:{
            TheTopNav,
            TheFooter,
            TheDashboardSideMenu,
            SuccessErrorMessage
        },
        methods:{
          getProfileUrl(){
              let url=this.me.image;
              return this.$helpers.getProfileUrl(url);
           }
        }
    }
</script>