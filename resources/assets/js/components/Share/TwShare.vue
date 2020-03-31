<template>
	<li>
		<a target="_blank"  style="display: inline-block;" @click="tw_share" :href="'https://twitter.com/intent/tweet?url='+url+'&text='+blog.title"><i class="fab fa-twitter"></i></a>
   	</li>
</template>

<script>
import Form from './../../services/Form.js'
    export default {
        name: 'share',
        props: ['blog', 'url'],

        data: function() {
            return {
				form:new Form({
                    code:this.blog.code,
                    media:'twitter'
                }),
            }
        },
       
        methods: {
        	
            tw_share:function(){
                let current= this;
                    $.getScript("https://platform.twitter.com/widgets.js", function(){
                       function handleTweetEvent(event){
                         if (event) {
                           current.form.post('/blog/detail/share').then(response => {
                               if(response.data.status){
                               }
                               else{
                                  this.$store.commit('SETFLASHMESSAGE',{status:false,message:'Some Error Occured.Please try again in a while.'});
                               }
                              }).catch(e => {
                            
                                this.$store.commit('SETFLASHMESSAGE',{status:false,message:e.message});
                              });
                         }
                       }
                       twttr.events.bind('tweet',handleTweetEvent);        
                     });

            },
            
        }
    }
</script>