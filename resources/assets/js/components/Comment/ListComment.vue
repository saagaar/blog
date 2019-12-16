<template>
<div>
	<div class="comment-list" v-if="comments.length>0">
		<div class="single-comment justify-content-between d-flex" v-for="eachComment in comments">
		    <div class="user justify-content-between d-flex">
		        <div class="thumb">
		       		<img :src="getProfileUrl(eachComment.user.image)">
		        </div>
		        <div class="desc">
		            <p class="comment">
		                {{ eachComment.comment }} 
		            </p>

		            <div class="d-flex justify-content-between">
		                <div class="d-flex align-items-center">
		                    <h5>
		                        <a href="#">{{ eachComment.user.name }} </a>
		                    </h5>
		                    <p class="date">{{ eachComment.created_at | moment("dddd, MMMM YYYY, h:mm:ss a") }} </p>
		                </div>

		            </div>

		        </div>
		    </div>
		</div>
	</div>
	<div class="comment-list" v-else>
		<div class="single-comment justify-content-between d-flex">
		    <div class="user justify-content-between d-flex">
		        No Comments Found
		    </div>
		</div>
	</div>
</div>
</template>
<script>
import mixin  from './../../mixins/LoadData.mixin.js';
    export default {
        
        data:function(){
          return {
            initialState:{},
            comments:[]
          }
        },
        
        computed: {
        	  allComments:function(){
                return this.$store.getters.listComments;
            }
        },
        watch: {
          allComments: function (newValue) {
            this.comments=newValue;          
          },
      },
        methods:{
        	getProfileUrl(url){
              return this.$helpers.getProfileUrl(url);
           },
       },
 
    }
</script>