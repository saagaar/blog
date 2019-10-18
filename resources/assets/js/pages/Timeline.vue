
<template>
            <div>
              <div id="main" class="">
                <div class="white-box create-post">
                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                      <form>
                         <!-- <textarea name="texts" id="exampleTextarea" cols="60" rows="1" class="form-control" placeholder="Write Bikash Bhandari Wall"></textarea> -->
                         <div class="col-md-8 col-sm-8">
                           <input type="text"  class="form-control" cols="45" placeholder="Search Post">
                         </div>
                         <div  class="col-md-4 col-sm-4">
                           <button class="btn sr-btn" type="submit"><i class="fa fa-search"></i></button>
                         </div>
                       
                      </form>
                    </div>
                    <!-- <div class="col-md-4 col-sm-4 pad-left-0">
                      <div class="tools">
                        <ul class="publishing-tools list-inline">
                          <li><a href="#"><i class="fa fa-edit"></i></a></li>
                          <li><a href="#"><i class="fa fa-image"></i></a></li>
                          <li><a href="#"><i class="fa fa-video"></i></a></li>
                        </ul>
                        <button class="btn btn-primary pull-right">Publish</button>
                      </div>
                    </div> -->
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12" v-if="isLoading===true">
                    
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12" v-else-if="initialState.profileBlog">
                    <div class="single-blog video-style small row m_b_30" v-for="eachBlog in initialState.profileBlog">
                      <div class="thumb col-lg-3 col-md-4 col-sm-5"> <img class="img-fluid" :src="'/images/blog/'+eachBlog.image" :alt="eachBlog.title"> </div>
                      <div class="short_details col-lg-9 col-md-8 col-sm-7"> <a class="d-block" href="single-blog.html">
                        <h4>{{eachBlog.title}}</h4>
                        </a>
                        <p v-if="eachBlog.short_description.length<500" v-html="eachBlog.short_description"></p>
                        <p v-else v-html="eachBlog.short_description.substring(0,500)+' ......' "></p>
                        <div class="meta-bottom d-flex"> <a href="#"><i class="ti-time"></i> {{eachBlog.created_at | moment("MMM DD") }} </a> <a href="#"><i class="ti-heart"></i> 0 like</a> <a href="#"><i class="ti-eye"></i> 1k view</a> </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12" v-else="!initialState.profileBlog && isLoading===false">
                    <div class="single-blog video-style small row m_b_30">
                      <div class="short_details col-lg-12 col-md-12 col-sm-12">
                        <h4 class="text-center d-block">No post available!!</h4>
                      </div>
                    </div>
                  </div>
                  
                  <!-- <div class="col-md-12 text-center">
                    <div class="lds-ring">
                      <div></div>
                      <div></div>
                      <div></div>
                      <div></div>
                    </div>
                    <div class="clearfix"></div>
                  </div> -->
                </div>
              </div>
              <div class="clearfix"></div>
              </div>
            
</template>

<script>

  import mixin  from './../mixins/LoadData.mixin.js';
    export default {
      mixins: [ mixin ],
         data:function(){
    return {
            initialState:{}
        }
      },
       methods:{
          isLoading:function()
          {
            return false;
            // alert(this.$store.getters.isLoading);
            return this.$store.getters.isLoading;
          },
        },
        components:{
          
        },
    }
</script>