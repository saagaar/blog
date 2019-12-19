<template>
	<a>
        <img v-if="isChecked" src="/frontend/images/elements/appreciate.png" width="25" height="25" class="img-fluid">
        <img v-else src="/frontend/images/elements/inactive-appreciate.png" width="25" height="25" class="img-fluid"> 
        </a>        	
</template>

<script>
import Form from './../../services/Form.js'
let action='';
    export default {
        name: 'likes',
        props: ['user', 'likes'],

        data: function() {
            return {
                isChecked:'',
                isLoading:false,
                count:''
            }
        },

        mounted() {
            var indexval=(Object.values(this.likes).indexOf(this.user));
            console.log(this.likes);
            if(indexval==-1)
            {
                this.isChecked=false;
            }else{
                this.isChecked=true;
            }
        },
    }
</script>