
<template>
<div>
<TheTopNav></TheTopNav>
<TheMainNav></TheMainNav>
 		<router-view></router-view>
        <div class="clearfix"></div>
<TheFooter></TheFooter>
</div>
</template>

<script>
  import { BulletListLoader,FacebookLoader } from 'vue-content-loader';
import mixin  from './../mixins/LoadData.mixin.js';
import TheTopNav from './../components/TopNav/TheTopNav';
import TheMainNav from './../components/MainNav/TheMainNav';
import TheFooter from './../components/Footer/TheFooter';
    export default {
        data() {
          return {
           initialState:{}
           }
        },
        // name:UserDashboard,
        mixin,
        computed:{
            me:function(){
              return this.$store.getters.me
            },
            
           
        },
        components:{
            TheTopNav,
            TheFooter,
            TheMainNav
        }
    }
</script>