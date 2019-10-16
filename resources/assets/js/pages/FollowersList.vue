<template>
<div id="main" class="">      
  <div class="friend-list fn_list_2" v-if="isLoading===true">
  </div>         
  <!-- ==== Friend List ==== -->
  <div class="friend-list fn_list_2" v-else-if="initialState.followers">
    <div class="col-md-6 col-sm-12"  v-for="eachFollowers in initialState.followers">
      <div class="friend-card">
          <div class="row card-info">
            <div class="col-lg-3 col-md-4">
              <img src="/images/user-3.jpg" alt="user" class="profile-photo-lg" />
            </div>
            <div class="col-lg-9 col-md-8">
              <div class="friend-info">
                <h5><a href="timeline.html" class="profile-link">{{eachFollowers.name}} </a></h5>
                <FollowButton  @clicked="userFollowed" :Buttonclass="'float-right text-green btn'" :username="eachFollowers.username" :followSuggestionHead="3"></FollowButton>
                <p>14960 Followers</p>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div> 
  <div class="friend-list fn_list_2">
  </div>               
</div>
</template>
<script>

  import mixin  from './../mixins/LoadData.mixin.js';
  import FollowButton from './../components/Follows/FollowButton';
    export default {
      mixins: [ mixin ],
         data:function(){
    return {
            initialState:{},
        }
      },
        
       methods:{
          userFollowed:function(user){
           var index=this.initialState.followers.filter(p => p.username == user);
               // remove after 1 second
              
            
          },
          isLoading:function()
          {
            return true;
            return this.$store.getters.isLoading;
          },
        },
        components:{
          FollowButton
          
        },
    }
</script>