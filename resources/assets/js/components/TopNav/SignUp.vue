<template>
<div>
<a href="#" @click="openSignUpModal"> <i class="fas fa-sign-in-alt">&nbsp;</i> Get Started</a>
</div>
</template>
<script>
import LoginMixin from './../../mixins/Login.mixins';
import LoginSignupModal from './LoginSignupModal';
 
    export default {
        components:{
           LoginSignupModal 
        },
        data() {
        	return {
           }
        },
        mixins:[LoginMixin]
    }
</script>
