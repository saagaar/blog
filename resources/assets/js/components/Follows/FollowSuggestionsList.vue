<template>
            <div class="suggestions">

                <h4 class="grey"><i class="fa fa-star"></i> Follow </h4>

                  <div v-if="followSuggestion.length>0">
                   <div class="follow-user" v-for="eachsuggestion in followSuggestion" >

                    <img :src="getProfileUrl(eachsuggestion.image)" alt="Profile Picture" class="profile-photo-sm pull-left" />
                    <div>
                      <h5><a :href="'/profile/'+eachsuggestion.username" class="profile-link">{{eachsuggestion.name}}</a></h5>
                      <FollowButton  @clicked="userFollowed" :following="following" :Buttonclass="'btn btn-sm btn-round btn-success'" :username="eachsuggestion.username" :followSuggestionHead="followSuggestion.length"></FollowButton>
                    </div>
                   </div>
                   </div>
                    <div v-else-if="this.$store.getters.isLoading===true" class="follow-user">
                        <PlaceHolderDashboardFeed></PlaceHolderDashboardFeed>
                   </div>
                   <div v-else class="follow-user">
                    No New suggestions
                   </div>
            </div>
</template>

<script>
import FollowButton from './FollowButton';
import PlaceHolderDashboardFeed  from './../ContentPlaceholder/PlaceHolderDashboardFeed';
    export default {
        props:['followSuggestion'],
        data() {
        	return {
              followSuggestionStart: '',
              isLoading:'',
              following:false,
              newUser:{name:'',username:'',image:''}
           }
        },
        watch:{
          'newUser.username':
          {
            handler: function (after, before) {
              this.followSuggestion.push(this.newUser)
            },
            deep: true
          }         
        },
        methods:{
          userFollowed:function(toRemoveUser,toAddUser){

              var index = this.followSuggestion.findIndex(obj => {
              return obj.username === toRemoveUser
            })                               
          
            this.followSuggestion.splice(index, 1);
            if(toAddUser[0]!==  undefined)
            {
              this.newUser=toAddUser[0];
            } 
          },
         getProfileUrl(url){
              return this.$helpers.getProfileUrl(url);
           },
          
        },
        components:{
            FollowButton,
            PlaceHolderDashboardFeed
        },
       

    }
</script>
