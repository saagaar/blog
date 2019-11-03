<template>
	<div>
         <a href="" @click.prevent="toggleLike" class="appreciate">
         	<img v-if="isChecked" src="/images/appreciate-active.gif" width="25" height="25" class="img-fluid">
        	<img v-else src="/images/appreciate.png" width="25" height="25" class="img-fluid">
   		</a>
   		<span>{{ count }} people like this</span>
   	</div>
</template>

<script>
import Form from './../../services/Form.js'
let action='';
    export default {
        name: 'likes',
        props: ['currentblog', 'likes','blogcode'],

        data: function() {
            return {
                isChecked:'',
                count:''
            }
        },

        mounted() {
            var indexval=(this.likes.indexOf(this.currentblog.id));
            if(indexval==-1)
            {
                this.isChecked=false;
            }else{
                this.isChecked=true;
            }
            this.count=this.currentblog.likes_count;
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
                        	
                        }

                  }).catch(e => {
                      console.log(e);
                  });

            }
            
        }
    }
</script>