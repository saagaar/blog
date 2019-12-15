<template>
	<div>
		<div>
    <strong>{{formName}} <a href='#' v-if="!isClicked" v-on:click.prevent="clicked"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>  </strong>
    </div>
		<div v-if="isClicked">
			<form method="post">
				<input type="text" class="form-control" id="editor" blur="$v.form.inputParams.$touch()" v-model="form.inputParams"></input>
				<div v-if="$v.form.inputParams.$anyDirty">
                              <div class="error" v-if="!$v.form.inputParams.required">This Field is required</div>
                              <div class="error" v-if="!$v.form.inputParams.maxLength">inputParams must be less {{ $v.form.inputParams.$params.maxLength.max }} letters.</div>
                              <div class="error" v-if="!$v.form.inputParams.minLength">inputParams must be at least {{ $v.form.inputParams.$params.minLength.min }} letters.</div>
                              <div class="error" v-if="!$v.form.inputParams.isUnique">This Email Address is Already Used</div>
                            </div>
				<button type="button" class="btn btn-primary ml-15" @click.prevent="updateDetails"><Loader></Loader>Update</button>
        <button type="button" class="btn btn-light ml-15" @click.prevent="cancel">Cancel</button>
			</form>
		</div>
		<div v-else>
		<span> {{value}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        
		</div>
        
	</div>
</template>
<script>
import Form from './../../services/Form.js';
import Loader from './../../components/Loader';
import { required, minLength,maxLength,email } from 'vuelidate/lib/validators';
    export default {
    	props: {
    		formName:String,
    		inputName:String,
    		value:String
    	},
        data() {
   			return {
	    	isClicked:false,
	    	form:new Form({
              inputParams:'',
              inputName:this.inputName

            })
        }
      },
      validations: {
          form:{
            inputParams: {
              required,
              minLength: minLength(4),
              maxLength: maxLength(150),
              email,
               async isUnique(value) {
                if (value === '') return true
                    
                        const response = await fetch('/user/emailupdatecheck/'+value)
                       return Boolean(await response.json())
                    
              }
            },
          }
        },
      computed:{
            me(){
              return this.$store.getters.user.loggedInUser
            },            
        },
        
        methods:{
        	clicked:function(){
        		this.isClicked=true;
            this.form.inputParams=this.value;
        	},
          cancel:function(){
            this.isClicked=false;
          },
        	updateDetails:function(){
            let curObject=this;
            this.$v.form.$touch();
            if(!this.$v.form.$invalid)
            {
              curObject.$store.commit('TOGGLE_LOADING');
              this.form.post('/user/change/details').then(response => {
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