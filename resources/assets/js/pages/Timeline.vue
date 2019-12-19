
<template>
            <div>
              <div  class="">
                <div class="white-box create-post"  v-if="$gate.allow('viewUserDashboard', 'profile', loggedIn)">
                <form>
                  <div class="row">
                         <div class="col-md-11 col-sm-10 blog-src">
                           <input type="text"  class="form-control" v-model.trim="search" cols="45" placeholder="Search Post">
                           <button class="btn btn-primary pull-right" @click.prevent="searchPost" type="submit"><i class="fa fa-search"></i></button> 
                         </div>
                         <div  class="col-md-1 col-sm-2 pad-left-0">
                           
                         </div>
                         <div class="clearfix"></div>
                  </div>
                  </form>                
                </div>

                  <div class="col-lg-12 col-md-12 col-sm-12" v-if="this.$store.getters.isLoading===true">
                           <PlaceHolderTimeline></PlaceHolderTimeline>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12" v-else-if="initialState.blogList.data && initialState.blogList.data.length>0">
                    <div class="single-blog video-style small row m_b_30" v-for="eachBlog in initialState.blogList.data">
                      <div class="thumb col-lg-3 col-md-4 col-sm-5">
                       <img v-if="eachBlog.image" class="img-fluid" :src="'/uploads/blog/'+eachBlog.code+'/'+eachBlog.image" :alt="eachBlog.title">
                       <img v-else class="img-fluid" :src="'/frontend/images/elements/default-post.jpg'" :alt="eachBlog.title">
                      </div>
                      <div class="short_details col-lg-9 col-md-8 col-sm-7"> <a class="d-block" :href="url(eachBlog)">
                        <h4>{{eachBlog.title}}</h4>
                        </a>
                        <p v-if="eachBlog.short_description.length<500" v-html="eachBlog.short_description"></p>
                        <p v-else v-html="eachBlog.short_description.substring(0,500)+' ......' "></p>
                        <div class="meta-bottom d-flex"> <a href="#"><i class="ti-time"></i> {{eachBlog.created_at | moment("MMM DD") }} </a> <a href="#"><i class="ti-heart"></i> {{eachBlog.likes_count}} like</a> <a href="#"><i class="ti-eye"></i> {{ eachBlog.views }} view</a> </div>
                      </div>
                    </div>
                    <div class="align-right">
                      <pagination :data="initialState.blogList"  :limit="-1" :show-disabled="true"  @pagination-change-page="getResults">
                   <span slot="prev-nav"><li>
                      <a class="np-btn" href="#"><i class="fa fa-angle-left  pagination-left"></i></a>
                    </li></span>
                   <span slot="next-nav"> <li>
                      <a class="np-btn" href="#"><i class="fa fa-angle-right pagination-right"></i></a>
                    </li></span>
                 </pagination>
                    </div>
                  </div>
                  <div v-else>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="single-blog video-style small row m_b_30">
                        <h4 class="text-center d-block">No Published  post !!</h4>
                      </div>
                    </div>
                  </div>

              </div>
              <div class="clearfix"></div>
              </div>
         
            
</template>

<script>

  import mixin  from './../mixins/LoadData.mixin.js';
  import PlaceHolderTimeline  from './../components/ContentPlaceholder/PlaceHolderTimeline';
  import Form  from './../services/Form.js';
    export default {
      mixins: [ mixin ],
         data:function(){
    return {
            form:new Form(),
            initialState:{},
            sort_by:'',
            filter_by:2,
            search:'',
        }
      },
      computed:{
         loggedIn(){
              return this.$store.getters.user.loggedInUser;
            }  
      },
      watch: {
          filter_by: function () {
            this.getResults();          
          },
          sort_by: function () {
            this.getResults();          
          },
          search(newValue, oldValue) {
           var newspacecount=newValue.split(' ').length;
           var oldspacecount=oldValue.split(' ').length;
            if(newspacecount!=oldspacecount)
            {
               this.getResults();
            }
            else if(newValue.trim()=='')
            {
              this.getResults();
            }        
          }
      },
       methods:{
        getResults(page = 1) {
          this.initialState.blogList={};
          this.$store.commit('TOGGLE_LOADING');
          this.form.get('api/profile?page='+page+'&search='+this.search+'&sort_by='+this.sort_by).then(response => {
               this.$store.commit('TOGGLE_LOADING');
               if(response.data)
               {
                this.initialState.blogList=response.data.blogList
               }
               else
               {
                  alert(response.data.message)
               }
              }).catch(e => 
              {
                 this.$store.commit('TOGGLE_LOADING');
                  // console.log(e);
              });
        },
        searchPost(){
         this.getResults();
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
              // alert(sl);
              // Change to lower case
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
          PlaceHolderTimeline
        },
    }
</script>