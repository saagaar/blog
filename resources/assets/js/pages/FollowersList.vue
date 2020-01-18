<template>
<div  class="">      
  <div  v-if="this.$store.getters.isLoading===true">
     <PlaceHolderFollowers></PlaceHolderFollowers>
    </div>         
    <!-- ==== Friend List ==== -->
    <div v-else-if="Object.entries(initialState.followers).length>0">
    <div class="friend-list fn_list_2" >
      <div class="col-md-6 col-sm-12"  v-for="eachFollowers in initialState.followers">
        <div class="friend-card">
            <div class="row card-info">
              <div class="col-lg-3 col-md-4">
                <img :src="getProfileUrl(eachFollowers.image)" alt="user" class="profile-photo-lg" />
              </div>
              
              <div class="col-lg-9 col-md-8">
                <div class="friend-info">
                  <h5><a :href="'/profile/'+eachFollowers.username"  class="profile-link">{{eachFollowers.name}} </a></h5>
                  <FollowButton  @clicked="userFollowed" :followings="initialState.authFollowing" :Buttonclass="'float-right'" :username="eachFollowers.username"  :followSuggestionHead="3"></FollowButton>
                  <p>{{eachFollowers.followers_count}} Followers</p>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="col-md-12 text-center">
       <InfiniteLoading @infinite="infiniteHandler" spinner="spiral">
          <div slot="no-more"></div>
          <div slot="no-results"><hr></div>
      </InfiniteLoading>
      </div>
    </div> 
   
    </div>
    <div class="friend-list fn_list_2" v-else>
     Sorry No followers yet!!
    </div>               
</div>
</template>
<script>
  import mixin  from './../mixins/LoadData.mixin.js';
  import FollowButton from './../components/Follows/FollowButton';
  import PlaceHolderFollowers  from './../components/ContentPlaceholder/PlaceHolderFollowers';
  import InfiniteLoading from 'vue-infinite-loading';
  import Form from './../services/Form.js';
    export default {
      mixins: [ mixin ],
         data:function(){
           return {
            initialState:{},
            isFollowing:false,
            offset: 1,
            form:new Form()
          }
      },
     watch:{
          initialState: function (val) {
            this.$store.commit('AUTH_FOLLOWING',this.initialState.authFollowing);
          },
      },
       methods:{
          userFollowed:function(user){
           var index=this.initialState.followers.filter(p => p.username == user);
          },
          infiniteHandler($state) {
              let username=this.$route.params.username;
              if(username===undefined)
              username='';
              this.form.get('/api/getfollowers/'+username+'?page='+this.offset).then(response => 
              {
                     if(response.data.data.length)
                     {
                       this.offset+=1;
                       this.initialState.followers.push(...response.data.data);
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
          PlaceHolderFollowers,
          InfiniteLoading
          
        },
    }
</script>