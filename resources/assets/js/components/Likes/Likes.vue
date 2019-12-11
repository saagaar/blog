<template>
	<div>
         <a href="" @click.prevent="toggleLike" class="appreciate">
         	<img v-if="isChecked" src="/frontend/images/elements/appreciate.gif" width="25" height="25" class="img-fluid">
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
        props: ['likescount','blogid', 'likes','blogcode'],

        data: function() {
            return {
                isChecked:'',
                count:''
            }
        },

        mounted() {
            var indexval=(this.likes.indexOf(this.blogid));
            if(indexval==-1)
            {
                this.isChecked=false;
            }else{
                this.isChecked=true;
            }
            this.count=this.likescount;
        },
       
        methods: {
            toggleLike:function(){
                             if(this.isChecked)
                            {
                                this.isChecked=false;
                            }
                            else
                            {
                                  this.isChecked=true;
                            } 
                action='/like/blog/'+this.blogcode;
                    var form=new Form();
                    form.post(action).then(response => {
                        if (response.data.status) {
                            
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