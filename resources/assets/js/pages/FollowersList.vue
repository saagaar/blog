<template>
<div id="main" class="">      
  <div  v-if="this.$store.getters.isLoading===true">
     <PlaceHolderFollowers></PlaceHolderFollowers>
    </div>         
    <!-- ==== Friend List ==== -->
    <div v-else-if="initialState.followers">
    <div class="friend-list fn_list_2" >
      <div class="col-md-6 col-sm-12"  v-for="eachFollowers in initialState.followers">
        <div class="friend-card">
            <div class="row card-info">
              <div class="col-lg-3 col-md-4" v-if="eachFollowers.image">
                <img :src="'/images/user-images/'+eachFollowers.image" alt="user" class="profile-photo-lg" />
              </div>
              <div class="col-lg-3 col-md-4"v-else>
                <img src="/images/system-images/default-profile.png" alt="user" class="profile-photo-lg" />
              </div>
              <div class="col-lg-9 col-md-8">
                <div class="friend-info">
                  <h5><a href="timeline.html" class="profile-link">{{eachFollowers.name}} </a></h5>
                  <FollowButton  @clicked="userFollowed" :followings="initialState.followings" :Buttonclass="'float-right'" :username="eachFollowers.username" :followSuggestionHead="3"></FollowButton>
                  <p>{{eachFollowers.followers_count}} Followers</p>
                </div>
              </div>
            </div>
          </div>
      </div>
      <FollowerLoading :following="initialState.followings"></FollowerLoading>
    </div> 
    </div>
    <div class="friend-list fn_list_2" v-else>
      No Records found
    </div>               
</div>
</template>
<script>

  import mixin  from './../mixins/LoadData.mixin.js';
  import FollowButton from './../components/Follows/FollowButton';
  import PlaceHolderFollowers  from './../components/ContentPlaceholder/PlaceHolderFollowers';
  import FollowerLoading from './../components/BlogLoading/FollowerLoading';

    export default {
      mixins: [ mixin ],
         data:function(){
    return {
            initialState:{},
            isFollowing:false
        }
      },
      
       methods:{
          userFollowed:function(user){
           var index=this.initialState.followers.filter(p => p.username == user);
               // remove after 1 second
          },
          
        },
        components:{
          FollowButton,
          PlaceHolderFollowers,
          FollowerLoading
          
        },
    }
</script>