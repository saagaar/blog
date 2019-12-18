<template>
<a href="#" @click="openLoginModal"> <i class="fas fa-user-circle">&nbsp;</i> Sign In</a>

</template>



<script>

// import TheLoginSignupModal from './TheLoginSignupModal';
  
import LoginMixin from './../../mixins/Login.mixins';
 
    export default {
      // components:{
      //      TheLoginSignupModal 
      //   },
        data() {
          return {
           }
        },
        methods:{

        },
        mixins:[LoginMixin]

    }
</script>
