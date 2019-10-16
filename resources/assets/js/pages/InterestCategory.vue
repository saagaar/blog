
<template>
<div class="col-md-9 col-sm-9" v-if="initialState.allCategories">
                <div id="main" class="">

            <!--================Category  Area Start =================-->

    <section class="category-page category-list"   v-for="eachCategory in initialState.allCategories">
            <div class="row">
                <div class="col-md-12">
                    <div class="area-heading">
                        <h3>{{eachCategory.name}}</h3>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-6" v-for="subCategory in eachCategory.categories">
                    <div class="single-category">
                        <div class="thumb" v-if="subCategory.banner_image">
                           <a href="#"> <img class="img-fluid" 
                            :src="'frontend/images/categories-images/'+subCategory.banner_image" alt=""></a>
                        </div>
                        <div class="thumb" v-else>
                           <a href="#"> <img class="img-fluid" 
                            :src="'frontend/images/categories-images/icon-no-image.svg'" alt=""></a>
                        </div>
                        <div class="short_details">
                            <a class="d-block" href="single-blog.html">
                                <h4>{{subCategory.name}} </h4>
                            </a>
                            <Favorite
                            :currentCategory="subCategory.slug"
                            :userInterest= "initialState.userInterest"
                        ></Favorite>


                        </div>
                    </div> 
                </div>
            </div>
 
    </section>
    <!--================Category  Area End =================-->
          </div>
        </div>
</template>

<script>p
import Favorite from './../components/Favorites/Favorite';
import mixin  from './../mixins/LoadData.mixin.js';
    export default {
        mounted() {
        },
        data:function(){
          return {
            initialState:{}
           // allCategories:[],
           //  userInterest:[],
            
          }
        },
        mixins:[mixin],
        components:{
            Favorite
        },
 
    }
</script>