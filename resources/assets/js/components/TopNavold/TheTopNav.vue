<template>
<div>
 <section class="header-top">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-4 col-md-4 col-sm-4 logo-wrapper">
                    <a href="/blog" class="logo">
                        <img src="/frontend/images/elements/logo-6.png" alt="">
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
                        <li><router-link to="/blog/add" title="Create Article"><i class="fa fa-plus-square" ></i></router-link></li>
                      
                        <li class="nitify dropdown" @click="updateNotificationStatus">
                            <a  href="javascript:void(0)" class="dropdown-toggle top_icon" 
                            data-toggle="dropdown" role="button" aria-haspopup="true" 
                            aria-expanded="false" title="Notifications"><i  class="fas fa-bell"></i> <em v-if="me.unReadNotificationsCount>0">{{ me.unReadNotificationsCount }}</em></a>

                               <NotificationsLoading :notificationlist="topnotifications" :loadtype="'noload'" :type="'nav'" ></NotificationsLoading>
                                
                        </li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <small>Welcome !</small>
                            <figure><img :src="getProfileUrl()"></figure> {{getFirstName()}}</a>
                            <ul class="dropdown-menu">
                                <li><router-link to="/dashboard">My Dashboard</router-link></li>

                            
                                <li><router-link to="/profile">Profile</router-link></li>
                                <li><router-link to="/categories">Choose your interest</router-link></li>
                                 <hr>
                                <li><router-link to="/blog/add">New Article</router-link></li>
                               
                                <li><router-link to="/blog/list">My Articles</router-link></li>
                                 <hr>
                               

                                <li><router-link to="/settings">Settings</router-link></li>
                                <!-- <li><a href="#">Help</a></li> -->
                                <!-- <li><a href="#">Change Password</a></li> -->
                                <li><a href="/logout/user">Log Out</a></li>
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

import Form from './../../services/Form.js';
import LoginButton from './LoginButton.vue';
import SignUpButton from './SignUpButton.vue';
import TheLoginSignupModal from './TheLoginSignupModal';
import NotificationsLoading  from './../../components/InfiniteLoading/NotificationsLoading.vue';
    export default {
       
        data() {
           return {
            topnotifications:[],
            readNotification:false
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
            updateNotificationStatus:function()
            {
                if(!this.readNotification)
                {

                   let cur=this;
                   var form=new Form();
                       form.get('/api/update-notification-status').then(response => 
                        {
                           if(response.data.status)
                           {
                             cur.readNotification=true;
                              this.$store.commit('UPDATE_UNREAD_NOTIFICATION_COUNT',response.data.data.unReadNotificationsCount);
                           }
                           else
                           {
                            
                           }
                          }).catch(e => 
                          {
                             this.$store.commit('SETFLASHMESSAGE',{status:false,message:e.message});
                          });
                }
            },
            getProfileUrl(){
              
              let url=this.me.image;
              return this.$helpers.getProfileUrl(url);
           },
           getFirstName(){
             let first = this.me.name.split(' ').slice(0, -1).join(' ');; 
             return first;
           }
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