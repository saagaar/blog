
<template>
<div class="row">
  <div class="col-md-9 col-sm-9 pad-left-0" v-if="this.$store.getters.isLoading===true">
      <PlaceHolderFollowings></PlaceHolderFollowings>
  </div>
  <div class="col-md-9 col-sm-9 pad-left-0" v-else-if="Object.entries(initialState.followings).length>0">
        <div class="friend-list" v-for="eachFollowings in initialState.followings">
          <div class="friend-card">
            <div class="row card-info">
              <div class="col-lg-3 col-md-4" v-if="eachFollowings.image">
                <img :src="'/uploads/user-images/'+eachFollowings.image" alt="user" class="profile-photo-lg" />
              </div>
              <div class="col-lg-3 col-md-4"v-else>
                <img src="/frontend/images/elements/default-profile.png" alt="user" class="profile-photo-lg" />
              </div>
              <div class="col-lg-9 col-md-8">
                <div class="friend-info">
                  <h5> <router-link :to="'/profile/'+eachFollowings.username" class="profile-link">{{eachFollowings.name}}</router-link></h5>
                 <!--  <a href="#" class="float-right text-green btn">Unfollow</a> -->
                 <FollowButton  @clicked="userFollowed" :following="true" :Buttonclass="'float-right'" :username="eachFollowings.username" :followSuggestionHead="followSuggestion.length" ></FollowButton>
                  <p>{{eachFollowings.followers_count}}  Followers</p>
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
    <div class="col-md-9 col-sm-9 pad-left-0" v-else>
      <div class="friend-list">
          <div class="friend-card">
            <div class="row card-info">
              You haven't followed anyone!!
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-3 pad-left-0">
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
        watch:{
        initialState: function (val) {
          this.followSuggestion=this.initialState.followSuggestion;
        },
      },
       methods:{
          userFollowed:function(user){
           var index=this.initialState.followings.filter(p => p.username == user);
               // remove after 1 second
                // (this.initialState.followings.splice(index, 1));
            
          },
          infiniteHandler($state) {
            this.form.get('/api/getfollowings?page='+this.offset).then(response => 
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
       
          
        },
        components:{
          FollowButton,
          FollowSuggestionsList,
          PlaceHolderFollowings,
          InfiniteLoading
        },
    }
</script>