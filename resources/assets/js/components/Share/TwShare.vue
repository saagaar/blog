<template>
	<li>
		<a @click="tw_share" :href="'https://twitter.com/intent/tweet?url='+url+'&text='+blog.title"><i class="fab fa-twitter"></i></a>
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
                    $.getScript("http://platform.twitter.com/widgets.js", function(){
                       function handleTweetEvent(event){
                         if (event) {
                           current.form.post('/blog/detail/share').then(response => {
                               if(response.data.status){
                                
                               }
                               else{
                                  
                               }
                              }).catch(e => {
                            
                              console.log(e);
                              });
                         }
                       }
                       twttr.events.bind('tweet',handleTweetEvent);        
                     });

            },
            
        }
    }
</script>