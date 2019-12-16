
<template>

<div class="col-md-9 col-sm-9">
      <div class="row">
        <div class="col-md-9 col-sm-9">

            <div class="col-lg-12 col-md-12 col-sm-12" v-if="this.$store.getters.isLoading===true">
                 <PlaceHolderDashboardFeed></PlaceHolderDashboardFeed>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12" v-if="initialState.blogByFollowing &&initialState.blogByFollowing.length>0">
              <div class="single-blog video-style small row m_b_30" v-for="eachBlog in initialState.blogByFollowing">
                <div class="thumb col-lg-3 col-md-4 col-sm-5">
                 <img  v-if="eachBlog.image" class="img-fluid" :src="'/uploads/blog/'+eachBlog.code+'/'+eachBlog.image" :alt="eachBlog.title">
                 <img v-else class="img-fluid" :src="'/images/system-images/default-post.jpg'" :alt="eachBlog.title">
                  </div>
                <div class="short_details col-lg-9 col-md-8 col-sm-7"> <a class="d-block" href="single-blog.html">
                  <h4>{{eachBlog.title}}</h4>
                  </a>
                  <p v-if="eachBlog.short_description.length<500" v-html="eachBlog.short_description"></p>
                  <p v-else v-html="eachBlog.short_description.substring(0,500)+' ......' "></p>
                  <div class="meta-bottom d-flex"> <a href="#"><i class="ti-time"></i> {{eachBlog.created_at | moment("MMM DD") }} </a> <a href="#"><i class="ti-heart"></i> 0 like</a> <a href="#"><i class="ti-eye"></i> 1k view</a> </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12" v-else>
              <div class="single-blog video-style small row m_b_30">
                <div class="short_details col-lg-12 col-md-12 col-sm-12">
                  <h4 class="text-center d-block">No post From your followings !!</h4>
                </div>
              </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 pad-left-0">
            <div class="white-box mb20">
                <FollowSuggestionsList   :followSuggestion="followSuggestion"></FollowSuggestionsList>
            </div>
            </div>
            <div class="clearfix"></div>
            </div>
</div>
</template>
<script>
import PlaceHolderDashboardFeed  from './../components/ContentPlaceholder/PlaceHolderDashboardFeed';
import mixin  from './../mixins/LoadData.mixin.js';
import FollowSuggestionsList from './../components/Follows/FollowSuggestionsList';
// import TheRightSideBar from './../components/TheRightSideBar';
    export default {
        mounted() {
            // console.log('Component mounted.')
        },
        mixins: [ mixin ],  
        data:function(){
          return {
            initialState:{},
            followSuggestion:'',
          }
        },
       watch: {
        initialState: function (val) {
          this.followSuggestion=this.initialState.followSuggestion;
        },
      },
    
      components:{
            // TheRightSideBar,
            FollowSuggestionsList,
            PlaceHolderDashboardFeed
        },
    }

   
</script>
