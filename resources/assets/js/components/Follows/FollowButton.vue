<template>
  <a v-if="$gate.allow('viewFollowButton', 'profile', loggedInUser)" href="" class="btn btn-sm  btn-round" :class="[Buttonclass,buttonDesign]"  @click.prevent="toggleFollow" ><i  
  :class="isLoading ? ' fa fa-circle-notch fa-spin' : ' fa fa-user-plus'"></i>  
  {{ isFollowing ? 'Unfollow' : 'Follow'}} 
  </a>
</template>

<script>
import Form from './../../services/Form.js';
import Loader from './../../components/Loader';
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
                isLoading:false,
        		    isFollowing: this.following,
                form:new Form(),
                fa:"fa",
                faClass:"fa fa-user-plus",
                buttonDesign:" text-green",


           }
        },
        computed:{
            loggedInUser:function(){
              return this.$store.getters.user.loggedInUser
            },
            me:function(){
              return this.$store.getters.me
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
          },
          isLoading:function(val)
          {
            if(val==true)
              this.faClass="fa fa-circle-notch fa-spin";
            else
              this.faClass="fa fa-user-plus";
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
         beforeUpdate() {
          if(this.following)
           this.isFollowing= this.following;
         
         },
        components:{
                Loader,
            },
        methods:
        {
          
        	toggleFollow:function(){
              this.isLoading=true;
              console.log(this.isFollowing);
        		if(!this.isFollowing)
        			action='api/followuser/'+this.username+'/'+this.followSuggestionHead;
        		else 
        			action='api/unfollowuser/'+this.username+'/'+this.followSuggestionHead;

	        		let curObject=this;
	        		this.form.get(action).then(response => {
		               if(response.data.status)
		               {
                          this.isLoading=false;
                          if(!this.isFollowing){
                            if(this.me.username===this.loggedInUser.username){
                              this.$store.commit('INCREMENT_FOLLOWING_COUNT', 1);
                            }
                            this.isFollowing=true;


                          }else{
                            if(this.me.username===this.loggedInUser.username){
                              this.$store.commit('DECREMENT_FOLLOWING_COUNT', 1);
                            }
                              this.isFollowing=false;
                              console.log(this.isFollowing);

                          }
		               	        this.$emit('clicked',this.username,response.data.message);
		               }
		               else
		               {
                    curObject.isLoad=false;
		               }
	              }).catch(e => {
                  curObject.isLoad=false;
	              });

        	},
      
        }
    }
</script>
