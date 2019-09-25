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
        		isFollowing: this.following
           }
        },
        methods:
        {
        	toggleFollow:function(){
        		if(!this.isFollowing)
        			action='api/followuser/'+this.username+'/'+this.followSuggestionHead;
        		else 
        			action='api/unFollowuser'+this.username+'/'+this.followSuggestionHead;
	        		var form=new Form();
	        		form.get(action).then(response => {
		               if(response.data.status)
		               {
		               	 this.$store.commit('INCREMENT_FOLLOWING_COUNT', 1);

		               	  this.$emit('clicked',this.username,response.data.message);
		        //        	    let index = state.followSuggestions.indexOf(user);
						    // // remove after 1 second
						    // setTimeout(function () {
						    //     state.followSuggestions.splice(index, 1);
						    // }, 1000);
		               }
		               else
		               {
		                 
		               }
	              }).catch(e => {
	                  console.log(e);
	              });

        	}
        }
    }
</script>
