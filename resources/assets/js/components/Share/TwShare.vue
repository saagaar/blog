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
        	increment:function(){
            	this.form.post('/blog/detail/share').then(response => {
	               if(response.data.status){
	               	// console.log(response);
	               }
	               else{
	                  
	               }
	              }).catch(e => {
              	
                  console.log(e);
	              });
            },
            tw_share:function(){
                    $.getScript("http://platform.twitter.com/widgets.js", function(){
                       function handleTweetEvent(event){
                        console.log(event);
                         if (event) {
                           alert("This is a callback from a tweet")
                         }
                       }
                       twttr.events.bind('tweet', handleTweetEvent);        
                     });




                // this.form.get()
    //         	window.twttr = (function (d,s,id) {
			 //    var t, js, fjs = d.getElementsByTagName(s)[0];
			 //    if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
			 //    js.src="https://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
			 //    return window.twttr || (t = { _e: [], ready:function(f){ t._e.push(f) } });
			 //    }(document, "script", "twitter-wjs"));
			 
				// twttr.ready(function (twttr) {
			 //    twttr.events.bind('tweet', function(event) {
			 //    	if (event) {
    //         	 	this.increment;
    //         	 }
			 //    });
				// });
            },
            
            
        }
    }
</script>