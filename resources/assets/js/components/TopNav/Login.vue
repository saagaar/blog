<template>
<a href="#" @click="openLoginModal"> <i class="fas fa-user-circle">&nbsp;</i> Sign In</a>

</template>



<script>

import LoginSignupModal from './LoginSignupModal';
  
import LoginMixin from './../../mixins/Login.mixins';
 
    export default {
      components:{
           LoginSignupModal 
        },
        data() {
          return {
           }
        },
        methods:{

        },
        mixins:[LoginMixin]

    }
</script>
