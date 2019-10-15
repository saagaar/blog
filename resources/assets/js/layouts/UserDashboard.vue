
<template>
<div>
<TheTopNav></TheTopNav>
<div class="mid_part" >
<!--================Dashboard =================-->
  <section class="dashboard_sec">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3">
               
            <div id="sidebar">      
            <div class="profile-card">
                <img src="/images/p_image.png" alt="user" class="profile-photo">
                <h5><router-link to="/profile"><!-- <a href="timeline.html" class="text-white"> -->{{ me.name}}</router-link></h5>
                <a href="#" class="text-white"><i class="ion ion-android-person-add"></i> {{ me.followersCount}} followers &nbsp;{{ me.followingCount}} following</a>
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
</script>