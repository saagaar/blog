<template>
      <div class="col-md-9 col-sm-9">
            <div class="white-box" style="padding-bottom: 0px;">
                <NotificationsLoading :notificationList="totalNotifications" :type="'fullPage'"></NotificationsLoading>
            </div>
             <div class="clearfix"></div>
      </div>
</template>
<script>

import mixin  from './../mixins/LoadData.mixin.js';
import NotificationsLoading  from './../components/InfiniteLoading/NotificationsLoading.vue';
    export default {
         mixins: [ mixin ],
         components: {
            NotificationsLoading,
         },
         data() {
          return {
                initialState: {},
                totalNotifications:[]
              }
          },
          watch:{
             initialState:function(newValue){
              this.totalNotifications=newValue.data.notifications
            },
          }
       
    }
</script>