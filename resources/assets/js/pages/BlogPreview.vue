<template>
     <div class="col-lg-8 posts-list pad-right-0">
                    <div class="white-box single-post">
                        <div class="feature-img">
                            <img class="img-fluid" src="img/blog/main-blog/m-blog-1.jpg" alt="">
                        </div>

                        <div class="blog_details">
                            <h2>Second divided from form fish beast made every of seas
                            all gathered us saying he our</h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><a href="#"><i class="far fa-user"></i> Sagar Chapagain</a></li>
                                <li><a href="#"><i class="far fa-comments"></i> 03 Comments</a></li>
                            </ul>
                            <p class="excert">
                                MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction of the camp price. However, who has the willpower

                            </p>
                            <p>
                                MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction of the camp price. However, who has the willpower to actually sit through a self-imposed MCSE training. who has the willpower to actually 
                            </p>
                            <div class="quote-wrapper">
                                <div class="quotes">
                                    MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction of the camp price. However, who has the willpower to actually sit through a self-imposed MCSE training.
                                </div>
                            </div>


                            <p>
                                MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction of the camp price. However, who has the willpower

                            </p>
                            <p>
                                MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction of the camp price. However, who has the willpower to actually sit through a self-imposed MCSE training. who has the willpower to actually 
                            </p>
                        </div>
                    </div>
                    
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