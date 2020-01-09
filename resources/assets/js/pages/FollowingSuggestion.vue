<template>
<div  class="">      
  <div  v-if="this.$store.getters.isLoading===true">
     <PlaceHolderFollowers></PlaceHolderFollowers>
    </div>         
    <!-- ==== Friend List ==== -->
    <div v-else-if="Object.entries(initialState.followSuggestion).length>0">
    <div class="friend-list fn_list_2" >
      <div class="col-md-6 col-sm-12"  v-for="eachFollowingSuggestion in initialState.followSuggestion">
        <div class="friend-card">
            <div class="row card-info">
              <div class="col-lg-3 col-md-4">
                <img :src="getProfileUrl(eachFollowingSuggestion.image)" alt="user" class="profile-photo-lg" />
              </div>
              
              <div class="col-lg-9 col-md-8">
                <div class="friend-info">
                  <h5><a :href="'/profile/'+eachFollowingSuggestion.username"  class="profile-link">{{eachFollowingSuggestion.name}} </a></h5>
                  <FollowButton :followings="initialState.authFollowing" :Buttonclass="'float-right'" :username="eachFollowingSuggestion.username" :followSuggestionHead="3"></FollowButton>
                  <p>{{eachFollowingSuggestion.followers_count}} Followers</p>
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
     Sorry No Suggestion Found!!
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
      
       methods:{
          infiniteHandler($state) {
              let username=this.$route.params.username;
              if(username===undefined)
              username='';
              this.form.get('/api/getfollowing/suggestion?page='+this.offset).then(response => 
              {
                     if(response.data.data.length)
                     {
                       this.offset+=1;
                       this.initialState.followSuggestion.push(...response.data.data);
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