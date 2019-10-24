<template>
	<div>
	<div class="comment-list" v-if="allcomment.length>0"  v-for="eachComment in allcomment">
		<div class="single-comment justify-content-between d-flex">
		    <div class="user justify-content-between d-flex">
		        <div class="thumb">
		            <img v-if="eachComment.user.image" :src="'/images/user-images/'+eachComment.user.image" alt="">
		            <img v-else :src="'/images/user-images/default.png'" alt="">
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

		                <div class="reply-btn">
		                    <a href="#" class="btn-reply text-uppercase">reply</a>
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
    	props: {
    		allcomment:Array
    	},
        mounted() {
        },
        data:function(){
          return {
            initialState:{}
            
          }
        },
        mixins:[mixin],
        components:{
        },
 
    }
</script>