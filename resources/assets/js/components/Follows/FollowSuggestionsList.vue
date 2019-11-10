<template>
            <div class="suggestions">

                <h4 class="grey"><i class="fa fa-star"></i> Follow </h4>

                  <div v-if="followSuggestion.length>0">
                   <div class="follow-user" v-for="eachsuggestion in followSuggestion" >

                    <img :src="eachsuggestion.image? '/images/user-images/'+eachsuggestion.image:'/images/system-images/default-profile.png'" alt="user" class="profile-photo-sm pull-left" />
                    <div>
                      <h5><a href="#">{{ eachsuggestion.name}}</a></h5>
                      <FollowButton  @clicked="userFollowed" :Buttonclass="'btn btn-sm btn-round btn-success'" :username="eachsuggestion.username" :followSuggestionHead="followSuggestion.length"></FollowButton>
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
           }
        },
        
        methods:{
          userFollowed:function(toRemoveUser,toAddUser){
           var index=this.followSuggestion.filter(p => p.username == toRemoveUser);

            if(toAddUser[0]!==  undefined)
            {
              this.followSuggestion.push(toAddUser[0]);
            }
               // remove after 1 second
              
                (this.followSuggestion.splice(index, 1));
            
          }
        },
        components:{
            FollowButton,
            PlaceHolderDashboardFeed
        },
       

    }
</script>
