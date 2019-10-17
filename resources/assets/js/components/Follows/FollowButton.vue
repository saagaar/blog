<template>
  <a href='' :class="Buttonclass" @click.prevent="toggleFollow" ><i class="fa fa-user-plus">&nbsp;</i> 
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
            followSuggestionHead:Number,
            Buttonclass:String,
            followings:Array,
        },
        data() {
        	return {
        		isFollowing: this.following,
                form:new Form()
           }
        },
        mounted() {
          if (this.followings) {
            var indexval=(this.followings.indexOf(this.username));
            if(indexval==-1)
            {
                this.isFollowing=false;
            }else{
                this.isFollowing=true;
            }
          }
            
        },
        methods:
        {
        	toggleFollow:function(){
               // this.$store.commit('TOGGLE_LOADING');

        		if(!this.isFollowing)
        			action='api/followuser/'+this.username+'/'+this.followSuggestionHead;
        		else 
        			action='api/unfollowuser/'+this.username+'/'+this.followSuggestionHead;
	        		
	        		this.form.get(action).then(response => {
		               if(response.data.status)
		               {
                          // this.$store.commit('TOGGLE_LOADING');
                          if(!this.isFollowing){
                            this.$store.commit('INCREMENT_FOLLOWING_COUNT', 1);
                            this.isFollowing=true;

                          }else{
   		               	       this.$store.commit('DECREMENT_FOLLOWING_COUNT', 1);
                              this.isFollowing=false;
                          }
                           this.$store.commit('TOGGLE_LOADING');
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
