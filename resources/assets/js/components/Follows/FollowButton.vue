<template>
  <a v-if="$gate.allow('viewFollowButton', 'profile', loggedInUser)" href="" class="btn btn-sm  btn-round" :class="[Buttonclass,buttonDesign]"  @click.prevent="toggleFollow" ><i class="fa fa-user-plus">&nbsp;</i> 
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
                form:new Form(),
                buttonDesign:" text-green"
           }
        },
        computed:{
            loggedInUser:function(){
              return this.$store.getters.user.loggedInUser
            },
          },
        watch:{
            isFollowing: function (val) {
              if(val==true)
               this.buttonDesign='text-green'
              else 
               this.buttonDesign='btn-success'   
          },
          username:function(val)
          {
            if(val)
              this.isFollowing=false;
          }
        },
        mounted() {
          if (this.followings) {
            var indexval=(this.followings.indexOf(this.username));
            if(indexval==-1)
            {
                this.isFollowing=false;
                this.buttonDesign='btn-success'   
                
                
            }else
            {
                this.isFollowing=true;
                this.buttonDesign='text-green'
            }
          }
            
        },
        methods:
        {
        	toggleFollow:function(){
        		if(!this.isFollowing)
        			action='api/followuser/'+this.username+'/'+this.followSuggestionHead;
        		else 
        			action='api/unfollowuser/'+this.username+'/'+this.followSuggestionHead;
	        		
	        		this.form.get(action).then(response => {
		               if(response.data.status)
		               {
                          if(!this.isFollowing){
                            this.$store.commit('INCREMENT_FOLLOWING_COUNT', 1);
                            this.isFollowing=true;

                          }else{
                             this.$store.commit('DECREMENT_FOLLOWING_COUNT', 1);
                              this.isFollowing=false;
                          }
		               	        this.$emit('clicked',this.username,response.data.message);
		               }
		               else
		               {
		               }
	              }).catch(e => {
	              });

        	},
      
        }
    }
</script>
