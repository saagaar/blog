
<template>

<div class="col-md-9 col-sm-9">
      <div class="row">
        <div class="col-md-12 col-sm-12">

            <div class="col-lg-12 col-md-12 col-sm-12" v-if="this.$store.getters.isLoading===true">
                 <PlaceHolderDashboardFeed></PlaceHolderDashboardFeed>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12" v-else-if="initialState.saved &&initialState.saved.length>0">
              <div class="single-blog video-style small row m_b_30" v-for="eachBlog in initialState.saved">
                <div class="thumb col-lg-3 col-md-4 col-sm-5">
                 <img  v-if="eachBlog.image" class="img-fluid" :src="getImageurl(eachBlog.code,eachBlog.image)" :alt="eachBlog.title">
                 <img v-else class="img-fluid" :src="'/frontend/images/elements/default-post.jpg'" :alt="eachBlog.title">
                  </div>
                <div class="short_details col-lg-9 col-md-8 col-sm-7"> 
                  <div class="meta-top d-flex">
                    <a v-if="eachBlog.anynomous==1" href="#">By Anynomyous</a>
                    <a v-else-if="eachBlog.user==null" href="#">By Admin</a>
                     <a v-else :href="'/profile/'+eachBlog.user.username">By {{ eachBlog.user.name }}</a>
                 </div>
                  <a class="d-block" :href="url(eachBlog)">
                  <h4>{{eachBlog.title}}</h4>
                  </a>
                  <p>{{eachBlog.short_description}}</p>
                  <div class="meta-bottom d-flex"> <a href="#"><i class="ti-time"></i> {{eachBlog.created_at | moment("MMM DD") }} </a>
                   <a href="" class="appreciate"><i>
                        <LikeCheck :likes="initialState.userliked" :code="eachBlog.code"></LikeCheck>
                    </i> {{eachBlog.likes_count}} appreciate</a>
                   <a href=""><i class="ti-eye"></i> {{eachBlog.views}} view</a>
                   <SaveBlog :saves="initialState.savedBlogCode" :blogcode="eachBlog.code" ></SaveBlog>
                    </div>
                </div>
              </div>
              <SavedBlogLoading  :saves="initialState.savedBlogCode" ></SavedBlogLoading>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12" v-else>
              <div class="single-blog video-style small row m_b_30">
                <div class="short_details col-lg-12 col-md-12 col-sm-12">
                  <h4 class="text-center d-block">No saved post !!</h4>
                </div>
              </div>
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
import SavedBlogLoading from './../components/InfiniteLoading/SavedBlogLoading';
import SaveBlog from './../components/Likes/SaveBlog';
import LikeCheck from './../components/Likes/LikeCheck';
    export default {
        mixins: [ mixin ],  
        data:function(){
          return {
            initialState:{},
            followSuggestion:'',
          }
        },
       watch: {
      },
      methods:{
        getImageurl:function(code,image){
          var img = image.split('.');
          var url = '/uploads/blog/'+code+'/'+img[0]+'-thumbnail.'+img[1];
          return url;
        },
        url(items){
          var blogslug= this.blogslug(items.title);
          var url = '/blog/detail/'+items.code+'/'+blogslug;
          return url;
        },
        blogslug: function(title) {
          var blogslug = this.sanitizeTitle(title);
          return blogslug;
        },
        sanitizeTitle: function(title) {
              var slug = "";
              var titleLower = title.toLowerCase();
              // Letter "e"
              slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e');
              // Letter "a"
              slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a');
              // Letter "o"
              slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o');
              // Letter "u"
              slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u');
              // Letter "d"
              slug = slug.replace(/đ/gi, 'd');
              // Trim the last whitespace
              slug = slug.replace(/\s*$/g, '');
              // Change whitespace to "-"
              slug = slug.replace(/\s+/g, '-');
              
              return slug;
            }
      },
      components:{
            SavedBlogLoading,
            FollowSuggestionsList,
            PlaceHolderDashboardFeed,
            SaveBlog,
            LikeCheck
        },
    }

   
</script>
