<template>
  <img class="mr-3" :src="image" alt="Profile Picture">
</template>



<script>

// import TheLoginSignupModal from './TheLoginSignupModal';
import Form from './../../services/Form.js';
 
    export default {
        props: {
            username: String,
        },
        data() {
          return {
             usernme:this.username,
             image:this.$helpers.getProfileUrl(),
             form:new Form()
           }
        },
        created(){
          this.getProfileUrl(this.username);
        },
        methods:{
           getProfileUrl(user){
              this.form.get('/api/getUserDetail/'+this.username).then(response => 
                {
                     this.image= this.$helpers.getProfileUrl(response.data.image);
                }).catch(e => 
                {
                   this.$store.commit('SETFLASHMESSAGE',{status:false,message:e.message});
                });
             
            },
        },
    }
</script>
