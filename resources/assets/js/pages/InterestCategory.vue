
<template>
<div class="col-md-9 col-sm-9" v-if="this.$store.getters.isLoading===true">
    <PlaceHolderCustomizeInterest></PlaceHolderCustomizeInterest>
</div>
<div class="col-md-9 col-sm-9" v-else-if="initialState.allCategories">
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
                            :src="'uploads/categories-images/'+subCategory.banner_image" alt=""></a>
                        </div>
                        <div class="thumb" v-else>
                           <a href="#"> <img class="img-fluid" 
                            :src="'uploads/categories-images/icon-no-image.svg'" alt=""></a>
                        </div>
                        <div class="short_details">
                            <a class="d-block" :href="'/getblogbycategory/'+subCategory.slug">
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
<div class="col-md-9 col-sm-9" v-else="isLoading===false && !initialState.allCategories">
   Sorry, No Category Found
</div>
</template>

<script>
import PlaceHolderCustomizeInterest  from './../components/ContentPlaceholder/PlaceHolderCustomizeInterest';
import Favorite from './../components/Favorites/Favorite';
import mixin  from './../mixins/LoadData.mixin.js';
    export default {
        mounted() {
        },
        data:function(){
          return {
            initialState:{},
            isLoading:false
           // allCategories:[],
           //  userInterest:[],
            
          }
        },
        mixins:[mixin],
        components:{
            Favorite,
            PlaceHolderCustomizeInterest
        },
        method:{
            isLoading:function()
            {

              // this.form.isLoading=this.$store.getters.isLoading
              return this.isLoading=this.$store.getters.isLoading;

            },
        },

 
    }
</script>