<template>
  <a href='' class="btn btn-sm btn-round btn-success" @click.prevent="toggleFollow" ><i class="fa fa-user-plus">&nbsp;</i> 
  {{ isFollowing ? 'Unfollow' : 'Follow'}}
  </a>
</template>

<script>
import Form from './../../services/Form.js'
let action='';
    export default {
    	name: 'followButton',
        props: {
            username: String,
            following: {type: Boolean, default: false},
            followSuggestionHead:Number
        },
        data() {
        	return {
        		isFollowing: this.following,
                form:new Form()
           }
        },
        methods:
        {
        	toggleFollow:function(){
               this.$store.commit('TOGGLE_LOADING');

        		if(!this.isFollowing)
        			action='api/followuser/'+this.username+'/'+this.followSuggestionHead;
        		else 
        			action='api/unFollowuser'+this.username+'/'+this.followSuggestionHead;
	        		
	        		this.form.get(action).then(response => {
		               if(response.data.status)
		               {
                          // this.$store.commit('TOGGLE_LOADING');
   		               	  this.$store.commit('INCREMENT_FOLLOWING_COUNT', 1);
		               	  this.$emit('clicked',this.username,response.data.message);
		               }
		               else
		               {
                          // this.$store.commit('TOGGLE_LOADING');
		               }
	              }).catch(e => {
                    // this.$store.commit('TOGGLE_LOADING');
	              });

        	},
            isLoading:function()
            {
              return this.form.isLoading;
            },
      
        }
    }
</script>
