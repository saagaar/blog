<template>
            <ul class="notifications_list " :class="[type=='nav' ? 'dropdown-menu':'']">
                <li>

                  <h4 class="grey"> <i class="fa fa-bell"></i> All Notifications </h4>
                </li>
                <li v-if="allNotifications.length>0" v-for="eachNotifications in allNotifications" class="media" :class="[eachNotifications.read_at ? '':'unreadnotification']" ><a href="#"><img class="mr-3" src="/images/user-1.jpg" alt="Generic placeholder image"><p class="media-body"> <b class="mt-0 mb-1">{{eachNotifications.data.message}}</b></p></a>
                 </li>
                 <li v-else>
                 <a href="#"><p class="media-body">No Notifications</p></a>
                 </li>
                  <InfiniteLoading v-if="allNotifications.length>0" @infinite="infiniteHandler" spinner="spiral">
                    <div slot="no-more"></div>
                     <div slot="no-results">-------------</div>
                  </InfiniteLoading>
                  <li v-if="type=='nav'" class="media">
                        <p class=" text-center"><router-link to="/users/notifications"> See All</router-link></p>
                    </li>
             </ul>
</template>

<script>
import InfiniteLoading from 'vue-infinite-loading';
import Form from './../../services/Form.js';

export default {
  props: {
    notificationList:Array,
    type:{type:String,default:'fullPage'}
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
    },
 
};
</script>