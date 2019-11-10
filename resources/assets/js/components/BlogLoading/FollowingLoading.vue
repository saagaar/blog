<template>
<div>
	    <div class="friend-list" v-if="lists.length>0" v-for="items in lists">
          <div class="friend-card">
            <div class="row card-info">
              <div class="col-lg-3 col-md-4" v-if="items.image">
                <img :src="'/images/user-images/'+items.image" alt="user" class="profile-photo-lg" />
              </div>
              <div class="col-lg-3 col-md-4"v-else>
                <img src="/images/system-images/default-profile.png" alt="user" class="profile-photo-lg" />
              </div>
              <div class="col-lg-9 col-md-8">
                <div class="friend-info">
                  <h5><a href="timeline.html" class="profile-link">{{items.name}}</a></h5>
                 <!--  <a href="#" class="float-right text-green btn">Unfollow</a> -->
                 <FollowButton  @clicked="userFollowed" :following="true" :Buttonclass="'float-right'" :username="items.username" :followSuggestionHead="followSuggestion.length" ></FollowButton>
                  <p>{{items.followers_count}}  Followers</p>
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
</template>

<script>
import FollowButton from './../../components/Follows/FollowButton';
import InfiniteLoading from 'vue-infinite-loading';
import Form from './../../services/Form.js';

export default {
  props:{
    followSuggestion: Array,
  },
  components: {
    InfiniteLoading,
    FollowButton
  },
  data(){
    return {
      offset: 1,
      lists: [],
      form:new Form()
    };
  },
  methods: {
    infiniteHandler($state) {
       
        this.form.get('/api/getfollowings?page='+this.offset).then(response => 
        {
               if(response.data.data.length)
               {
                 this.offset+=1;
                 this.lists.push(...response.data.data);
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
 
};
</script>