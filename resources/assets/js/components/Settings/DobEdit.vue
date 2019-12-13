<template>
	<div>
		<div>
    <strong>{{formName}} <a href='#' v-if="!isClicked" v-on:click.prevent="clicked"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a> </strong>
    </div>
		<div v-if="isClicked">
			<form method="post">
				<datepicker class="form-control" :format="customFormatter" :value="me.dob" blur="$v.form.inputParams.$touch()" v-model="form.inputParams"></datepicker>
				<div v-if="$v.form.inputParams.$anyDirty">
                              <div class="error" v-if="!$v.form.inputParams.required">This Field is required</div>
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
import Datepicker from 'vuejs-datepicker';
import moment from 'moment';

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
          customFormatter(date) {
		      return moment(date).format('YYYY-MM-DD');
		    },
        	updateDetails:function(){
            let curObject=this;
            this.$v.form.$touch();
            if(!this.$v.form.$invalid)
            {
              this.form.post('/user/change/details').then(response => {
               if(response.data.status){
                 curObject.$store.commit('SETFLASHMESSAGE',{status:true,message:response.data.message});
                 this.isClicked=false;
                 // curObject.$store.commit('TOGGLE_LOADING');
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
 			Loader,
 			Datepicker
        },
    }
</script>