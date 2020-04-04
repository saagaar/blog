<template>
<a href="#" @click="openSignUpModal" @click.prevent="validateform"> &nbsp;<i class="fas fa-sign-in-alt">&nbsp;</i> {{text}}</a>
</template>
<script>
import LoginMixin from './../../mixins/Login.mixins';
// import LoginSignupModal from './LoginSignupModal';
 
    export default {
        // components:{
        //    LoginSignupModal 
        // },
        props: {
            text:{type:String,default:'Sign Up'},
          },
        data() {
        	return {
           }
        },
        mixins:[LoginMixin]
    }
</script>
