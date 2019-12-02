<template>
	<li>
		<a class="fb-share" href="javascript:void(0);" @click="fb_share(url,blog.title)"><i class="fab fa-facebook-f"></i></a>
   	</li>
</template>

<script>
import Form from './../../services/Form.js'
let action='';
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
            fb_share:function(url,title){
            	 var app_id = '671302589946860';
		    var pageURL="https://www.facebook.com/dialog/feed?app_id=" + app_id + "&link=" + url;
		    var w = 600;
		    var h = 400;
		    var left = (screen.width / 2) - (w / 2);
		    var top = (screen.height / 2) - (h / 2);
		    window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=yes, scrollbars=no, resizable=no, copyhistory=no, width=' + 800 + ', height=' + 650 + ', top=' + top + ', left=' + left)
		     FB.ui({
                method: 'share',
                href: url,
                }, function(response){
                    console.log(response);
                    if(response!==undefined)
                    {
                        this.increment();
                    }
                });
            },
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
           
        }
    }
</script>