
<template>
<div class="col-md-9 col-sm-9"  v-if="allCategories.length>0">
                <div id="main" class="">

            <!--================Category  Area Start =================-->

    <section class="category-page category-list"   v-for="eachCategory in allCategories">
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
                        <div class="thumb">
                           <a href="#"> <img class="img-fluid" 
                            :src="'/images/user-images/category/'+subCategory.banner_image" alt=""></a>
                        </div>
                        <div class="short_details">
                            <a class="d-block" href="single-blog.html">
                                <h4>{{subCategory.name}} </h4>
                            </a>

                            <Favorite
                            :currentCategory="subCategory.slug"
                            :userInterest= "userInterest"
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

<script>
        // function previewimage(event) {
            
        //     var reader = new FileReader();
        //     var imageField = document.getElementById("image-field")
        //     reader.onload = function () {
        //         if (reader.readyState == 2) {
        //             imageField.src = reader.result;
        //         }
        //     }
        //     reader.readAsDataURL(event.target.files[0]);
        // 
import Favorite from './../components/Favorites/Favorite';
// Vue.component('favorite', require('./Favorites/Favorite.vue'));
import mixin  from './../mixins/LoadData.mixin.js';
    export default {
        mounted() {
           
        },
        data:function(){
          return {
           allCategories:[],
            userInterest:[],
            
          }
        },
        mixins:[mixin],
        components:{
            Favorite
        },
        methods:{
          
        }
    }
</script>