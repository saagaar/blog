<template>
	<div>
		
		<div v-if="isClicked">
			<form method="post">
				<label>Old Password</label>
				<input type="password" class="form-control" blur="$v.form.oldpassword.$touch()" v-model="form.oldpassword"></input>
				<div v-if="$v.form.oldpassword.$anyDirty">
                              <div class="error" v-if="!$v.form.oldpassword.required">This Field is required</div>
                              <div class="error" v-if="!$v.form.oldpassword.minLength">oldpassword must be at least {{ $v.form.oldpassword.$params.minLength.min }} letters.</div>
                            </div>
				<br>
				<label>New Password</label>
				<input type="password" class="form-control" blur="$v.form.password.$touch()" v-model="form.password"></input>
				<div v-if="$v.form.password.$anyDirty">
                              <div class="error" v-if="!$v.form.password.required">This Field is required</div>
                              <div class="error" v-if="!$v.form.password.minLength">New Password must be at least {{ $v.form.password.$params.minLength.min }} letters.</div>
                            </div>
				<br>
				<label>Confirm Password</label>
				<input type="password" class="form-control" blur="$v.form.repassword.$touch()" v-model="form.repassword"></input>
				<div v-if="$v.form.repassword.$anyDirty">
                              <div class="error" v-if="!$v.form.repassword.required">This Field is required</div>
                              <div class="error" v-if="!$v.form.repassword.minLength">Confirm Password must be at least {{ $v.form.repassword.$params.minLength.min }} letters.</div>
                            </div>
				<br>
				<button type="button" class="btn btn-primary ml-15" @click.prevent="updateDetails"><Loader></Loader>Update</button>
        <button type="button" class="btn btn-light ml-15" @click.prevent="cancel">Cancel</button>
			</form>
		</div>
		<div v-else>
			<div>
		    <strong>Change Password</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='' v-if="!isClicked" v-on:click.prevent="clicked"><i class="fa fa-edit" aria-hidden="true"></i>Change</a>  
		    </div>
		
        
		</div>
        
	</div>
</template>
<script>
import Form from './../../services/Form.js';
import Loader from './../../components/Loader';
import { required,sameAs, minLength,maxLength } from 'vuelidate/lib/validators';
    export default {
        data() {
   			return {
	    	isClicked:false,
	    	form:new Form({
	    	  oldpassword:'',
              password:'',
              repassword:''

            })
        }
      },
      validations: {
          form:{
          	oldpassword: 
            {
              required,
               minLength: minLength(6)
            },
            password: 
            {
              required,
               minLength: minLength(6)
            },
            repassword: 
            {
              required,
               minLength: minLength(6),
               sameAsPassword: sameAs("password")
 
            }
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
        	},
          cancel:function(){
            this.isClicked=false;
          },
        	updateDetails:function(){
            let curObject=this;
            this.$v.form.$touch();
            if(!this.$v.form.$invalid)
            {
              this.form.post('/user/change/password').then(response => {
               if(response.data.status){
                 curObject.$store.commit('SETFLASHMESSAGE',{status:true,message:response.data.message});
                 this.isClicked=false;
                 
                 curObject.$store.commit('TOGGLE_LOADING');
                 curObject.$store.commit('ADD_ME',response.data.data.me);
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
 			Loader
        },
    }
</script>