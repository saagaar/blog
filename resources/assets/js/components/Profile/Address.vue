<template>
	<div>
		<div>
    <h4 class="text-left"><i class="fa fa-map-marked">&nbsp;</i> Address</h4><a href='' v-if="!isClicked" class="text-right" v-on:click.prevent="clicked"><i class="fa fa-edit" aria-hidden="true"></i></a>  
    </div>
		<div v-if="isClicked">
			<form method="post">
				<input type="text" name="address" class="form-control" id="editor" blur="$v.form.address.$touch()" v-model="form.address"></input>
				<div v-if="$v.form.address.$anyDirty">
                              <div class="error" v-if="!$v.form.address.required">This Field is required</div>
                              <div class="error" v-if="!$v.form.address.maxLength">Address must be less {{ $v.form.address.$params.maxLength.max }} letters.</div>
                              <div class="error" v-if="!$v.form.address.minLength">Address must be at least {{ $v.form.address.$params.minLength.min }} letters.</div>
                            </div>
				<br>
        <input type="text" name="country" class="form-control" id="editor" blur="$v.form.country.$touch()" v-model="form.country"></input>
        <div v-if="$v.form.country.$anyDirty">
                              <div class="error" v-if="!$v.form.country.required">This Field is required</div>
                              <div class="error" v-if="!$v.form.country.maxLength">country must be less {{ $v.form.country.$params.maxLength.max }} letters.</div>
                              <div class="error" v-if="!$v.form.country.minLength">country must be at least {{ $v.form.country.$params.minLength.min }} letters.</div>
                            </div>
                            <br>
				<button type="button" class="btn btn-primary ml-15" @click.prevent="updateAddress"><Loader></Loader>Update</button>
        <button type="button" class="btn btn-light ml-15" @click.prevent="cancel">Cancel</button>
			</form>
		</div>
		<div v-else>
		<p class="text-center"> {{me.address}}/{{me.country}}</p>
        
		</div>
        
	</div>
</template>
<script>
import Form from './../../services/Form.js';
import Loader from './../../components/Loader';
import { required, minLength,maxLength } from 'vuelidate/lib/validators';
    export default {
         data() {
    return {
    	isClicked:false,
    	form:new Form({
              address:'',
              country:''
            })
        }
      },
      validations: {
          form:{
            address: {
              required,
              minLength: minLength(4),
              maxLength: maxLength(150)
            },
            country: {
              required,
              minLength: minLength(2),
              maxLength: maxLength(50)
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
            this.form.address=this.me.address;
            this.form.country=this.me.country;
        	},
          cancel:function(){
            this.isClicked=false;
          },
        	updateAddress:function(){
            let curObject=this;
            this.$v.form.$touch();
            if(!this.$v.form.$invalid)
            {
              this.form.post('/user/change/address').then(response => {
               if(response.data.status){
                 curObject.$store.commit('SETFLASHMESSAGE',{status:true,message:response.data.message});
                 this.isClicked=false;
                 // curObject.$store.commit('TOGGLE_LOADING');
                 curObject.$store.commit('UPDATE_ADDRESS',response.data.data.addressName);
                 curObject.$store.commit('UPDATE_COUNTRY',response.data.data.countryName);
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