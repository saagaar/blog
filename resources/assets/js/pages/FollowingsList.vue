  
<template>
<div class="row">
  <div class="col-lg-9 col-md-8 col-sm-7 col-12 follow_list pad-left-0" v-if="this.$store.getters.isLoading===true">
      <PlaceHolderFollowings></PlaceHolderFollowings>
  </div>
  <div class="col-lg-9 col-md-8 col-sm-7 col-12 follow_list pad-left-0" v-else-if="Object.entries(initialState.followings).length>0">
        <div class="friend-list" v-for="eachFollowings in initialState.followings">
          <div class="friend-card">
            <div class="row card-info">
              <div class="col-lg-3 col-md-4 col-sm-4 col-4 " v-if="eachFollowings.image">
                <img :src="getProfileUrl(eachFollowings.image)" alt="user" class="profile-photo-lg" />
              </div>
              <div class="col-lg-3 col-md-4 col-sm-4 col-4" v-else>
                <img src="/frontend/images/elements/default-profile.png" alt="user" class="profile-photo-lg" />
              </div>
              <div class="col-lg-9 col-md-8 col-sm-8 col-8">
                <div class="friend-info">
                  <h5> <a :href="config.ROOT_URL+'profile/'+eachFollowings.username" class="profile-link">{{eachFollowings.name}}</a></h5>
                 <!--  <a href="#" class="float-right text-green btn">Unfollow</a> -->
                 <p>{{eachFollowings.followers_count}}  Followers</p>
                 <FollowButton  @clicked="userFollowed"  :followings="initialState.authFollowing" :Buttonclass="'float-right'" :username="eachFollowings.username" :followSuggestionHead="followSuggestion.length" >
                 </FollowButton>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
           <InfiniteLoading @infinite="infiniteHandler" spinner="spiral">
            <div slot="no-more"></div>
            <div slot="no-results"><hr></div>
          </InfiniteLoading>
    </div>
    <div class="col-lg-9 col-md-8 col-sm-7 col-12 follow_list pad-left-0" v-else>
      <div class="friend-list">
          <div class="friend-card">
            <div class="row card-info">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <h4 style="color: red">No Followings Yet !!</h4>
            </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-5 col-12 suggestion_list pad-left-0">
      <div class="white-box mb20">
          <FollowSuggestionsList   :followSuggestion="followSuggestion"></FollowSuggestionsList>
              </div>
              <div class="clearfix"></div>
              <!-- <div id="sidebar2" class="white-box mb20">
              <div class="suggestions">
                <h4 class="grey"><i class="fa fa-star"></i>  Add to your feed</h4>
                <div class="follow-user">
                  <img src="img/user-1.jpg" alt="" class="profile-photo-sm pull-left">
                  <div>
                    <h5><a href="timeline.html">Sangita Dhital</a></h5>
                    <a href="#" class="text-green"><i class="fa fa-plus">&nbsp;</i> Follow</a>
                  </div>
                </div>
                <div class="follow-user">
                  <img src="img/user-2.jpg" alt="" class="profile-photo-sm pull-left">
                  <div>
                    <h5><a href="timeline.html">Sagar Chapagain</a></h5>
                    <a href="#" class="text-green"><i class="fa fa-plus">&nbsp;</i> Follow</a>
                  </div>
                </div>
                <div class="follow-user">
                  <img src="img/user-3.jpg" alt="" class="profile-photo-sm pull-left">
                  <div>
                    <h5><a href="timeline.html">Binita Thakur</a></h5>
                    <a href="#" class="text-green"><i class="fa fa-plus">&nbsp;</i> Follow</a>
                  </div>
                </div>
                <div class="follow-user">
                  <img src="img/user-4.jpg" alt="" class="profile-photo-sm pull-left">
                  <div>
                    <h5><a href="timeline.html">Biswas Shrestha</a></h5>
                    <a href="#" class="text-green"><i class="fa fa-plus">&nbsp;</i> Follow</a>
                  </div>
                </div>
                <div class="follow-user">
                  <img src="img/user-6.jpg" alt="" class="profile-photo-sm pull-left">
                  <div>
                    <h5><a href="timeline.html">Bikash Bhandari</a></h5>
                    <a href="#" class="text-green"><i class="fa fa-plus">&nbsp;</i> Follow</a>
                  </div>
                </div>
          </div>
      </div> -->
    </div>
    </div>

</template>

<script>

  import mixin  from './../mixins/LoadData.mixin.js';
  import FollowButton from './../components/Follows/FollowButton';
  import FollowSuggestionsList from './../components/Follows/FollowSuggestionsList';
  import PlaceHolderFollowings  from './../components/ContentPlaceholder/PlaceHolderFollowings';
  import InfiniteLoading from 'vue-infinite-loading';
  import Form from './../services/Form.js';
    export default {
      mixins: [ mixin ],
         data:function(){
    return {
            initialState:{},
            followSuggestion:'',
            offset: 1,
            form:new Form()
        }
      },
      created(){
        // console.log(this.initialState.authFollowing);
      },
      computed:{
        config:function(){
         return this.$store.getters.config;
        },
      },
      watch:{
          initialState: function (val) {
            this.followSuggestion=this.initialState.followSuggestion;
            this.$store.commit('AUTH_FOLLOWING',this.initialState.authFollowing);
          },
      },
       
      methods:{
          userFollowed:function(user){
           var index=this.initialState.followings.filter(p => p.username == user);
          },
          infiniteHandler($state){
            let username=this.$route.params.username;
            if(username===undefined)
             username='';
            this.form.get('/api/getfollowings/'+username+'?page='+this.offset).then(response => 
            {
                   if(response.data.data.length)
                   {
                     this.offset+=1;
                     this.initialState.followings.push(...response.data.data);
                     $state.loaded();
                   }
                   else
                   {
                     $state.complete();
                   }
                  }).catch(e => 
                  {
                     this.$store.commit('SETFLASHMESSAGE',{status:false,message:e.message});
                  });
          },
          getProfileUrl(url){
              return this.$helpers.getProfileUrl(url);
          },
          
      },
      components:{
          FollowButton,
          FollowSuggestionsList,
          PlaceHolderFollowings,
          InfiniteLoading
      },
    }
</script>