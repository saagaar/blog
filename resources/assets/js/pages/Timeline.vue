
<template>
            <div>
              <div id="main" class="">
                <div class="white-box create-post">
                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                      <form>
                         <div class="col-md-8 col-sm-8">
                           <input type="text"  class="form-control" v-model.trim="search" cols="45" placeholder="Search Post"><button class="btn btn-primary pull-right" @click.prevent="searchPost" type="submit">Search</button>
                         </div>
                         <div  class="col-md-4 col-sm-4">
                           
                         </div>
                       
                      </form>
                    </div>
                  </div>
                </div>
                <div class="row">

                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="single-blog video-style small row m_b_30">
                      <div class="thumb col-lg-3 col-md-4 col-sm-5"> <img class="img-fluid" src="images/magazine/12.jpg" alt="Blog Image Name Goes Here"> </div>
                      <div class="short_details col-lg-9 col-md-8 col-sm-7"> <a class="d-block" href="single-blog.html">
                        <h4>Blessed night morning on
                          them you great</h4>
                        </a>
                        <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part that is observable to us. If you look just at the portion of the Universe we can see, you can measure its spatial curvature, and find that it’s incredibly close to flat...</p>
                        <div class="meta-bottom d-flex"> <a href="#"><i class="ti-time"></i>mar 12</a> <a href="#"><i class="ti-heart"></i> 0 like</a> <a href="#"><i class="ti-eye"></i> 1k view</a> </div>
                      </div>
                    </div>
                  </div>
                </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="single-blog video-style small row m_b_30 ">
                      <div class="thumb col-lg-3 col-md-4 col-sm-5"> <img class="img-fluid" src="images/magazine/13.jpg" alt="Blog Image Name Goes Here"> </div>
                      <div class="short_details col-lg-9 col-md-8 col-sm-7"> <a class="d-block" href="single-blog.html">
                        <h4>Blessed night morning on
                          them you great</h4>
                        </a>
                        <p>Inflation did not occur at arbitrarily high energies. There’s an energy scale at which the laws of physics no longer make sense: the Planck scale, or about 1019 GeV. This is about 100 trillion times larger than the maximum energies the LHC achieves…</p>
                        <div class="meta-bottom d-flex"> <a href="#"><i class="ti-time"></i>mar 12</a> <a href="#"><i class="ti-heart"></i> 0 like</a> <a href="#"><i class="ti-eye"></i> 1k view</a> </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="single-blog video-style small row m_b_30">
                      <div class="thumb col-lg-3 col-md-4 col-sm-5"> <img class="img-fluid" src="images/magazine/14.jpg" alt="Blog Image Name Goes Here"> </div>

                  <div class="col-lg-12 col-md-12 col-sm-12" v-if="this.$store.getters.isLoading===true">
                    
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12" v-else-if="initialState.blogList">
                    <div class="single-blog video-style small row m_b_30" v-for="eachBlog in initialState.blogList.data">
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
                  <div class="col-lg-12 col-md-12 col-sm-12" v-else>
                    <div class="single-blog video-style small row m_b_30">

                      <div class="thumb col-lg-3 col-md-4 col-sm-5"> <img class="img-fluid" src="images/magazine/12.jpg" alt="Blog Image Name Goes Here"> </div>
                      <div class="short_details col-lg-9 col-md-8 col-sm-7"> <a class="d-block" href="single-blog.html">
                        <h4>Blessed night morning on
                          them you great</h4>
                        </a>
                        <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part that is observable to us. If you look just at the portion of the Universe we can see, you can measure its spatial curvature, and find that it’s incredibly close to flat. No regions...</p>
                        <div class="meta-bottom d-flex"> <a href="#"><i class="ti-time"></i>mar 12</a> <a href="#"><i class="ti-heart"></i> 0 like</a> <a href="#"><i class="ti-eye"></i> 1k view</a> </div>

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
            </div>
          </div>
            
</template>

<script>

  import mixin  from './../mixins/LoadData.mixin.js';
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
                  console.log(e);
              });
        },
        searchPost(){
         this.getResults();
        },
      },
        components:{
          
        },
    }
</script>