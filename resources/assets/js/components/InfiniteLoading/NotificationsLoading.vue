<template>
            <ul class="notifications_list " :class="[type=='nav' ? 'dropdown-menu':'']">
                <li>

                  <h4 class="grey"> <i class="fa fa-bell"></i> All Notifications </h4>
                </li>
                <li>
                  <ul class="allnotificationlist ">
                      <li v-if="allNotifications" v-for="eachNotifications in allNotifications" class="media" :class="[eachNotifications.read_at ? '':'unreadnotification']" ><a href="#"><img class="mr-3" :src="getProfileUrl(eachNotifications.data.user)" alt="Generic placeholder image"> </a><p class="media-body" v-html="eachNotifications.data.message"><b class="mt-0 mb-1">2 days ago</b></p>
                       </li>
                       <li v-else>
                       <a href="#"><p class="media-body">No Notifications</p></a>
                       </li>
                        <InfiniteLoading v-if="allNotifications.length>0" @infinite="infiniteHandler" spinner="spiral">
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

export default {
  props: {
    notificationList:{type:Array,default: function () { return [] }},
    type:{type:String,default:'fullPage'},
    loadtype:{type:String,default:'noload'},

  },
  components: {
    InfiniteLoading,
  },
 data:function(){
    return {
      offset: 1,
      allNotifications:this.notificationList,
      form:new Form()
    };
  },
  created(){
    if(window.__NOTIFICATION__!==undefined){
      let notifications=JSON.parse(window.__NOTIFICATION__) || {};
      this.allNotifications=notifications;
    }
  },
  watch:{
    notificationList:function(newValue){
       this.allNotifications=newValue
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
                 cur.$data.allNotifications.push(...response.data.data.notifications);
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
        notifications(){
          let notifications=JSON.parse(window.__NOTIFICATION__) || {};
          return notifications;
        },
        getProfileUrl(user){
          // console.log(user);
          let url=user.image;
          return this.$helpers.getProfileUrl(url);
       },

    },
 
};
</script>