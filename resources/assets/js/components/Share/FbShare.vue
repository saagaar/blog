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
                    media:'facebook'
                }),
            }
        },
       created: function() {

          window.fbAsyncInit = function() {
            FB.init({
              appId            : '671302589946860',
              autoLogAppEvents : true,
              xfbml            : true,
              version          : 'v5.0'
            });
            //This function should be here, inside window.fbAsyncInit
            FB.getLoginStatus(function(response) {
           });
          };

          (function(d, s, id){
           var js, fjs = d.getElementsByTagName(s)[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement(s); js.id = id;
           js.src = "//connect.facebook.net/en_US/sdk.js";
           fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));
          },
        methods: {
            fb_share:function(url,title){
              let current= this;
      		     FB.ui({
                      method:'share',
                      href: this.url,
                      name:'social-share',
                      }, function(response){
                          if(response!==undefined)
                          {
                              current.increment();
                          }
                      });
                  },
            increment:function(){
                this.form.post('/blog/share').then(response => {
                   if(response.data.status){
                      
                   }
                   else{
                       this.$store.commit('SETFLASHMESSAGE',{status:false,message:'Some Error Occured.Please try again in a while.'});
                      
                   }
                  }).catch(e => {
                       this.$store.commit('SETFLASHMESSAGE',{status:false,message:e.message});
                  });
            },
           
        }
    }
</script>