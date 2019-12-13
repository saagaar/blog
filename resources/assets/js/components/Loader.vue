
<template>
                 <span v-if="loader">  <i class='fa fa-circle-notch fa-spin'></i></span>
</template>

<script>
    export default 
    {
        
         data:function(){
           return {
                loader:false,
           }
        },  
       computed:{
              isLoading() { 
                return this.$store.state.isLoading 
              },
            },
        watch: {
         
          isLoading(newValue) {
           this.loader=newValue;
           
          }
        },
    }
</script>
<style type="text/css">

.fa-spin{
	size: 20px
}
</style>
