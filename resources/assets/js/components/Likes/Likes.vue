<template>
	<div>
         <a href="" @click.prevent="toggleLike" class="appreciate">
                <img v-if="isChecked" src="/frontend/images/elements/appreciate.png" width="25" height="25" class="img-fluid">
                <img v-else src="/frontend/images/elements/inactive-appreciate.png" width="25" height="25" class="img-fluid">
         	
   		</a>
   		<span>{{ count }} people Appreciate this</span>
   	</div>
</template>

<script>
import Form from './../../services/Form.js'
let action='';
    export default {
        name: 'likes',
        props: ['currentblog','blogid', 'likes','blogcode'],

        data: function() {
            return {
                isChecked:'',
                isLoading:false,
                count:''
            }
        },

        mounted() {
            if(this.likes){
                var indexval=(this.likes.indexOf(this.blogid));
                if(indexval==-1)
                {
                    this.isChecked=false;
                }else{
                    this.isChecked=true;
                }
            }
            this.count=this.currentblog.likes_count;
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
                            if(this.isChecked)
                            {
                                this.isChecked=false;
                            }
                            else
                            {
                                  this.isChecked=true;
                            } 
                        	return this.count = response.data.likes['0'].likes_count; 
                        }else{
                            if(this.isChecked)
                            {
                                this.isChecked=false;
                            }
                            else
                            {
                                  this.isChecked=true;
                            } 
                        }

                  }).catch(e => {
                      console.log(e);
                  });

            }
            
        }
    }
</script>