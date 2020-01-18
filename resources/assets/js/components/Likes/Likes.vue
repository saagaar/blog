<template>
         <a href="" @click.prevent="toggleLike" class="appreciate">
                <img v-if="this.$store.getters.isLikedCurrentBlog" src="/frontend/images/elements/appreciate.png" width="25" height="25" class="img-fluid">
                <img v-else src="/frontend/images/elements/inactive-appreciate.png" width="25" height="25" class="img-fluid">
       		<span>{{ this.$store.getters.likes }} {{text}}</span>
        </a>
</template>

<script>
import Form from './../../services/Form.js'
let action='';
    export default {
        name: 'likes',
        props: ['currentblog','blogid', 'likes','blogcode','text'],

        data: function() {
            return {
                isChecked:'',
                isLoading:false,
            }
        },
        mounted() {
            if(this.likes){
                var indexval=(this.likes.indexOf(this.blogid));
                if(indexval==-1)
                {
                    this.$store.commit('TOGGLE_LIKED_CURRENT_BLOG',false);
                }else{
                    this.$store.commit('TOGGLE_LIKED_CURRENT_BLOG',true);
                }
            }
            this.$store.commit('LIKES_COUNT',this.currentblog.likes_count);
        },
       computed:{
            me(){
              return this.$store.getters.me
            },
            loggedIn(){
              return this.$store.getters.user.loggedInUser;
            }   
        },
        methods: {
            toggleLike:function(){
                let curObject=this;
                if(!this.likes){
                    curObject.$store.commit('TOGGLE_LOADING');
                    curObject.$store.commit('SETFLASHMESSAGE',{status:false,message:'You must login first'});
                    return;
                }
                this.isLoading=true;
                action='/like/blog/'+this.blogcode;
                    var form=new Form();
                    form.post(action).then(response => {
                        if (response.data.status) {
                            this.isLoading=false;
                            if(this.$store.getters.isLikedCurrentBlog)
                            {
                                curObject.$store.commit('TOGGLE_LIKED_CURRENT_BLOG',false);
                            }
                            else
                            {
                                  curObject.$store.commit('TOGGLE_LIKED_CURRENT_BLOG',true);
                            } 
                        	this.$store.commit('LIKES_COUNT',response.data.likes['0'].likes_count); 
                        }else{
                            if(this.$store.getters.isLikedCurrentBlog)
                            {
                                curObject.$store.commit('TOGGLE_LIKED_CURRENT_BLOG',false);
                            }
                            else
                            {
                                  curObject.$store.commit('TOGGLE_LIKED_CURRENT_BLOG',true);
                            } 
                        }

                  }).catch(e => {
                      console.log(e);
                  });

            }
            
        }
    }
</script>