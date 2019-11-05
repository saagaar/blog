<template>
<div>
 <section class="header-top">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-4 col-md-4 col-sm-4 logo-wrapper">
                    <a href="/blog" class="logo">
                        <img src="/images/logo.png" alt="">
                    </a>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 search-trigger">
                    <div class="right-button">

                        <ul v-if="!isUserloggedIn" >
                            <li><a id="search" href="javascript:void(0)"><i class="fas fa-search"></i></a></li>
                            <li><LoginButton></LoginButton></li>
                            <li><SignUpButton></SignUpButton></li>
                            
                        </ul>
                         <ul v-else>
                        <li><a id="search" @click="OpenSearchBox" href="javascript:void(0)"><i class="fas fa-search"></i></a></li>
                      
                        <li class="nitify dropdown">
                            <a  href="javascript:void(0)" class="dropdown-toggle top_icon" 
                            data-toggle="dropdown" role="button" aria-haspopup="true" 
                            aria-expanded="false" title="Notifications"><i class="fas fa-bell"></i> <span>Notifications</span> <em>{{ me.unReadNotificationsCount }}</em></a>

                               <NotificationsLoading :notificationList="topnotifications" :type="'nav'" ></NotificationsLoading>
                                
                        </li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <small>Welcome !</small>
                            <figure><img :src="'/images/user-images/'+me.image"></figure> {{ me.name}}</a>
                            <ul class="dropdown-menu">
                                <li><a href="/dashboard">My Profile</a></li>
                            
                                <li><a href="#">New Stories</a></li>
                                <li><a href="#">Stories</a></li>
                                <hr>
                                <li><a href="#">BlogSagar Partner Program</a></li>
                                <li><a href="#">Bookmarks</a></li>
                                <li><a href="#">Publications</a></li>
                                <li><a href="#">Customize your interest</a></li>
                                <hr>
                                <li><a href="#">Settings</a></li>
                                <li><a href="#">Help</a></li>
                                <li><a href="#">Change Password</a></li>
                                <li><a v-bind:href="config.ROOT_URL+'logout/user'">Log Out</a></li>
                            </ul>
                        </li>
                    </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="search_input" id="search_input_box" ref="search_input_box" >
            <div class="container ">
                <form class="d-flex justify-content-between search-inner">
                    <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="ti-close" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>

    </section>
    
      <TheLoginSignupModal></TheLoginSignupModal>
      </div>
    


</template>

<script>


import LoginButton from './LoginButton.vue';
import SignUpButton from './SignUpButton.vue';
import TheLoginSignupModal from './TheLoginSignupModal';
import NotificationsLoading  from './../../components/InfiniteLoading/NotificationsLoading.vue';
    export default {
       
        data() {
           return {
            topnotifications:[]
           }
        },
        computed:{
            isUserloggedIn:function(){
              return this.$store.getters.user.isLoggedIn
            },
            config:function(){
               return this.$store.getters.config;
            },
            me:function(){
              this.topnotifications=this.$store.getters.me.notifications
              return this.$store.getters.me
             
            },
           
        },
        
        methods:{
             OpenSearchBox:function()
            {
                $("#search_input_box").slideToggle();
                $("#search_input").focus();
            },
         },
        components:{
                SignUpButton,
                LoginButton,
                TheLoginSignupModal,
                NotificationsLoading,
            },
    }
</script>
<style type="text/css " scoped>
    #search_input_box{
        display: none
    }

</style>