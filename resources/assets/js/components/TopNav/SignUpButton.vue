<template>
<a href="#" @click="openSignUpModal"> &nbsp;<i class="fas fa-sign-in-alt">&nbsp;</i> {{text}}</a>
</template>
<script>
import LoginMixin from './../../mixins/Login.mixins';
// import LoginSignupModal from './LoginSignupModal';
 
    export default {
        // components:{
        //    LoginSignupModal 
        // },
        props: {
            text:{type:String,default:'Get Started'},
          },
        data() {
        	return {
           }
        },
        mixins:[LoginMixin]
    }
</script>
