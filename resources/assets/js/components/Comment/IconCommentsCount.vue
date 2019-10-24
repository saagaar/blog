<template>
	<a href="#"><i class="far fa-comments"></i> {{ commentsCount }} Comments</a> 
</template>
<script>
    export default {
        computed:{
            commentsCount:function(){
                return this.$store.getters.listComments.length;
            }
        },
    }
</script>