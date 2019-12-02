<template>
     <div class="col-lg-8 posts-list pad-right-0">
                    <div class="white-box single-post">
                        <div class="feature-img">
                             <img  v-if="initialState.blog.image" class="img-fluid" :src="'/uploads/blog/'+initialState.blog.code+'/'+initialState.blog.image" :alt="initialState.blog.title">
                              <img v-else class="img-fluid" :src="'/images/system-images/default-post.jpg'" :alt="initialState.blog.title">
                        </div>
                        <div class="blog_details">
                            <h2 v-html="initialState.blog.title"></h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><a href="#"><i class="far fa-user"></i>{{initialState.blog.user.name}}</a></li>
                                <li><IconCommentsCount></IconCommentsCount></li>
                            </ul>
                            <p v-html="initialState.blog.content"></p>
                        </div>
                    </div>
                    
                </div>
</template>
<script>
import IconCommentsCount from './../components/Comment/IconCommentsCount';
import mixin  from './../mixins/LoadData.mixin.js';
    export default {
         mixins:[mixin],
         components: {
         },
         data() {
          return {
                initialState:{},
              }
          },
          components:{
            IconCommentsCount
          }
       
    }
</script>