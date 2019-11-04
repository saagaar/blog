<template>
	<div>
		<div>
    <h4 class="text-left"><i class="fa fa-info-circle">&nbsp;</i>Bio</h4><a href='' v-if="!isClicked" class="text-right" v-on:click.prevent="clicked"><i class="fa fa-edit" aria-hidden="true"></i></a>  
    </div>
		<div v-if="isClicked">
			<form method="post">
				<input type="text" name="bio" class="form-control" id="editor" blur="$v.form.bio.$touch()" v-model="form.bio"></input>
				<div v-if="$v.form.bio.$anyDirty">
                              <div class="error" v-if="!$v.form.bio.required">This Field is required</div>
                              <div class="error" v-if="!$v.form.bio.maxLength">bio must be less {{ $v.form.bio.$params.maxLength.max }} letters.</div>
                              <div class="error" v-if="!$v.form.bio.minLength">bio must be at least {{ $v.form.bio.$params.minLength.min }} letters.</div>
                            </div>
				<br>
				<button type="button" class="btn btn-primary ml-15" @click.prevent="updateBio">Update</button>
				<button type="button" class="btn btn-light ml-15" @click.prevent="cancel">Cancel</button>
			</form>
		</div>
		<div v-else>
		<p class="text-center"> {{me.bio}}</p>
        
		</div>
        
	</div>
</template>
<script>
import Form from './../../services/Form.js';
import { required, minLength,maxLength } from 'vuelidate/lib/validators';
    export default {
         data() {
    return {
    	isClicked:false,
    	form:new Form({
              bio:'',
            })
        }
      },
      validations: {
          form:{
            bio: {
              required,
              minLength: minLength(4),
              maxLength: maxLength(150)
            },
          }
        },
      computed:{
            me(){
              return this.$store.getters.me
            },            
        },
        
        methods:{
        	clicked:function(){
        		this.isClicked=true;
            this.form.bio=this.me.bio;
        	},
        	cancel:function(){
        		this.isClicked=false;
        	},
        	updateBio:function(){
            let curObject=this;
            this.$v.form.$touch();
            if(!this.$v.form.$invalid)
            {
              this.form.post('/user/change/bio').then(response => {
               if(response.data.status){
               	this.isClicked=false;
                 curObject.$store.commit('SETFLASHMESSAGE',{status:true,message:response.data.message});
                 curObject.$store.commit('TOGGLE_LOADING');
                 curObject.$store.commit('UPDATE_BIO',response.data.data.bioName);
               }
               else{
                 curObject.$store.commit('SETFLASHMESSAGE',{status:false,message:response.data.message});
                  curObject.$store.commit('TOGGLE_LOADING');
               }
              }).catch(e => {
                   curObject.$store.commit('TOGGLE_LOADING');
                  if(e.status===false)
                     curObject.$store.commit('SETFLASHMESSAGE',{status:false,message:e.message});
                    else
                   curObject.$store.commit('SETFLASHMESSAGE',{status:false,message:e.message});
              });
            }
        	}
        },
        components:{
 
        },
    }
</script>