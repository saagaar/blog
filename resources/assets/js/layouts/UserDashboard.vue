
<template>
<div>
<TheTopNav></TheTopNav>
<div class="mid_part" >
<!--================Dashboard =================-->

  <section class="dashboard_sec">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3">
            <SuccessErrorMessage></SuccessErrorMessage>
            <div id="sidebar">      
            <div class="profile-card">
                <img :src="getProfileUrl()" :alt="me.name" class="profile-photo">
                <h5><router-link to="/profile"  class="text-white">{{ me.name}}</router-link></h5>
                  <router-link to="/followers" class="text-white">{{ me.followersCount}} followers</router-link>
                  <router-link to="/followings" class="text-white">{{ me.followingCount}} following</router-link>
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
              console.log('we are here');
              if(url===''){
                return 'frontend/images/elements/default-profile.png';
              }
              else if(url.indexOf('://') > 0 || url.indexOf('//') === 0){
                return url;
              }
              else{
                return '/uploads/user-images/'+url;
              }
           }
        }
    }
</script>