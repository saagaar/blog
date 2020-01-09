<template>
	<div>
<<<<<<< HEAD
		<a href="" @click.prevent="toggleSave" class="book_mark" >
			<i class="fa" :class="isChecked ? 'fa-clipboard-check' : 'fa-bookmark'"></i>
=======
		<a href="" @click.prevent="toggleSave" class="book_mark">
			<i v-if="!isChecked" class="fa fa-bookmark"></i>
			<i v-else class="fa fa-clipboard-check"></i> 
>>>>>>> avi
		{{ isChecked ? 'Saved' : 'Save'}} </a>
   	</div>
</template>

<script>
import Form from './../../services/Form.js'
let action='';
    export default {
        name: 'saves',
        props: {
	      saves:{type:Array},
	      blogcode:{type:String},
	    },

        data: function() {
            return {
                isChecked:false,
                isLoading:false,
                count:'',
                faClass:'fa',
                setClass:'fa-bookmark'
            }
        },
        watch:{
            isChecked:function(newval){
                if(newval)
                {
                    this.setClass=' fa-clipboard-check';
                }
                else{
                    this.setClass=' fa-bookmark';
                }
            }
        },
        mounted() {
            if(this.saves){
                var indexval=(this.saves.indexOf(this.blogcode));
                if(indexval==-1)
                {
                    this.isChecked=false;
                }else{
                    this.isChecked=true;
                }
            }
        },
       computed:{
            me(){
              return this.$store.getters.me
            },
            loggedIn(){
              return this.$store.getters.user.loggedInUser;
            }              
        },
        methods: {
            toggleSave:function(){
                let curObject=this;
                if(!this.saves){
                    curObject.$store.commit('TOGGLE_LOADING');
                    curObject.$store.commit('SETFLASHMESSAGE',{status:false,message:'You must login first'});
                    return;

                }
                this.isLoading=true;
                action='/save/blog/'+this.blogcode;
                    var form=new Form();
                    form.post(action).then(response => {
                        if (response.data.status) {
                            this.isLoading=false;
                            if(this.isChecked)
                            {
                                this.isChecked=false;
                            }
                            else
                            {
                                  this.isChecked=true;
                            } 
                        }else{
                            if(this.isChecked)
                            {
                                this.isChecked=false;
                            }
                            else
                            {
                                  this.isChecked=true;
                            } 
                        }

                  }).catch(e => {
                      console.log(e);
                  });

            }
            
        }
    }
</script>