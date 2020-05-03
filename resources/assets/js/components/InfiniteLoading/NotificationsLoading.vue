<template>
            <ul class="notifications_list " :class="[type=='nav' ? 'dropdown-menu':'']">
                <li>
                  <h4 class="grey"> <i class="fa fa-bell"></i> All Notifications </h4>
                </li>
                <li>
                  <ul class="allnotificationlist" >
                      <li  v-for="eachNotifications in allNotifications" class="media" :class="[eachNotifications.read_at ? '':'unreadnotification']" >
                        <a href="#">  <img class="mr-3" :src="getProfileUrl(eachNotifications.data.user.image)" alt="Profile Picture"> </a><p class="media-body" v-html="eachNotifications.data.message">
                        <b class="mt-0 mb-1">2 days ago</b></p>
                      </li>

                      <!--  <li v-else>
                         <a href="#"><p class="media-body">No New Notifications</p></a>
                       </li> -->
                       <InfiniteLoading  @infinite="infiniteHandler" spinner="spiral">
                         <div slot="no-more"></div>
                         <div slot="no-results">-------------</div>
                       </InfiniteLoading>
                  </ul>
                </li>
                 <li class="seeall">
                        <p class=" text-center">
                          <a v-if="loadtype=='fullload'" href="/users/notifications">See All</a>
                          <router-link v-else to="/users/notifications"> See All</router-link>
                        </p>
                 </li>
             </ul>
</template>

<script>
import InfiniteLoading from 'vue-infinite-loading';
import Form from './../../services/Form.js';
import ProfileImageNotification from './../TopNav/ProfileImageNotification';
export default {
  props: {
    notificationList:{type:Array},
    type:{type:String,default:'fullPage'},
    loadtype:{type:String,default:'noload'},

  },
  components: {
    InfiniteLoading,
    ProfileImageNotification
 },
 data:function(){
    return {
      offset: 1,
      allNotifications:[],
      form:new Form(),
      image:this.$helpers.getProfileUrl(),
      name:''
    };
  },
 
  mounted(){
    if(window.__NOTIFICATION__!==undefined){
      let notifications=JSON.parse(window.__NOTIFICATION__) || [];
      this.allNotifications=notifications;
    }
  },
  watch:{
    type:function(newValue){
       // alert(type);
    }
  },
  methods: {
    infiniteHandler($state) {
      let cur=(this);
        cur.form.get('/api/users/notifications?page='+this.offset).then(response => 
        {
               if(response.data.data.notifications.length>0)
               {
                  this.offset+=1;
                  this.allNotifications.push(...response.data.data.notifications);
                  this.$store.commit('UPDATE_UNREAD_NOTIFICATION_COUNT',response.data.data.unReadNotificationsCount);
                  $state.loaded();
               }
               else
               {
                 $state.complete();
               }
              }).catch(e => 
              {
                 this.$store.commit('SETFLASHMESSAGE',{status:false,message:e.message});
              });
        },
         getProfileUrl(url){
              
              return this.$helpers.getProfileUrl(url);
           },
       

    },
 
};
</script>