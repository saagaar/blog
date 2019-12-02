<template>
  
	<div>
    <div id="display-message" v-if="message">
<div class="" v-if="status===true" >


  <div id="message-data" ><i class="fa fa-check-circle text-success"></i> {{ message}}.</div>
</div>

<div class="" v-if="status===false">
  <div id="message-data"  > <i class="fa fa-exclamation-triangle text-warning"></i> {{ message}}.</div>
</div>
</div>
		<form class="contact-form-footer">
          <input class="form-control" type="text" @blur="$v.form.name.$touch()" name="name"  v-model="form.name" placeholder="Name">
          <div v-if="$v.form.name.$anyDirty">
                              <div class="error" v-if="!$v.form.name.required">This Field is required</div>
                              <div class="error" v-if="!$v.form.name.maxLength">name must be less {{ $v.form.name.$params.maxLength.max }} letters.</div>
                              <div class="error" v-if="!$v.form.name.minLength">name must be at least {{ $v.form.name.$params.minLength.min }} letters.</div>
                            </div>
          <input class="form-control" type="text" @blur="$v.form.email.$touch()" name="email"  v-model="form.email"  placeholder="email">
          <div v-if="$v.form.email.$anyDirty">
                              <div class="error" v-if="!$v.form.email.required">This Field is required</div>
                              <div class="error" v-if="!$v.form.email.maxLength">email must be less {{ $v.form.email.$params.maxLength.max }} letters.</div>
                              <div class="error" v-if="!$v.form.email.minLength">email must be at least {{ $v.form.email.$params.minLength.min }} letters.</div>
                            </div>
            <input class="form-control" type="text" @blur="$v.form.phone.$touch()" name="phone"  v-model="form.phone"  placeholder="phone">
          <div v-if="$v.form.phone.$anyDirty">
                              <div class="error" v-if="!$v.form.phone.required">This Field is required</div>
                              <div class="error" v-if="!$v.form.phone.maxLength">phone must be less {{ $v.form.phone.$params.maxLength.max }} letters.</div>
                              <div class="error" v-if="!$v.form.phone.minLength">phone must be at least {{ $v.form.phone.$params.minLength.min }} letters.</div>
                              <div class="error" v-if="!$v.form.phone.numeric">phone must be Numbers.</div>
                            </div>
          <textarea class="form-control" @blur="$v.form.message.$touch()" name="message"  v-model="form.message"  placeholder="message" ></textarea> 
          <div v-if="$v.form.message.$anyDirty">
                              <div class="error" v-if="!$v.form.message.required">This Field is required</div>
                              <div class="error" v-if="!$v.form.message.maxLength">message must be less {{ $v.form.message.$params.maxLength.max }} letters.</div>
                              <div class="error" v-if="!$v.form.message.minLength">message must be at least {{ $v.form.message.$params.minLength.min }} letters.</div>
                            </div>
          <button type="submit" @click.prevent="submitForm()" class="btn btn-primary  primary-shadow btn-sm">Send</button>
        </form>
	</div>
</template>
<script>
import { required, minLength, maxLength,numeric } from 'vuelidate/lib/validators';
import Form from './../../services/Form.js';
import SuccessErrorMessage from './../../components/SuccessErrorMessage.vue';
export default {
        data() {
          return {
                form:new Form({
                    name:'',
                    email:'',
                    phone:'',
                    message:''
                }),
                message:'',
                status:''
            }
         },
        validations: {
          form:{
            name: {
              required,
              minLength: minLength(4),
              maxLength: maxLength(150)
            },
            email: {
              required,
              minLength: minLength(4),
              maxLength: maxLength(150)
            },
            phone: {
              required,
              minLength: minLength(4),
              maxLength: maxLength(150),
              numeric
            },
            message: {
              required,
              minLength: minLength(4),
              maxLength: maxLength(150)
            },
          }
        },
        methods:{
        	submitForm:function(){
                this.$v.form.$touch();
                let curObject=this;
            if(!this.$v.form.$invalid)
            {
              curObject.form.post('/contact/form').then(response => {
                curObject.removeFlashMessageData();
               if(response.data.status){
               	// console.log(response);
               	curObject.status=true;
                curObject.message=response.data.message;
                  // window.location.href="/blog/detail/"+curObject.blogCode
               }
               else{
                  curObject.status=false;
                curObject.message=response.data.message;
               }
              }).catch(e => {
                  curObject.removeFlashMessageData();
                  curObject.status=false;
                  curObject.message=e.message;
              });
            }
          },
          removeFlashMessageData(){
            var self = this;
             setTimeout(function(){
                  self.message=false;
                  self.status=false;
             },5000);
          },
        },
    }
</script>
<style type="text/css" scoped>
#display-message{
    border: 1px solid;
    min-width: 200px;
    max-width: 500px;
    height: auto;
    position: relative;
    z-index: 1000;
    float: right;
    left: 1px;
    background:#3c2a2a;
    opacity: 0.7;
    border-top-left-radius: 18px;
    border-bottom-left-radius: 20px;
    color: white;
    top:-26px;
    font-size: 16px;
    padding: 16px;
    position: fixed;
    top: 80px;
    left: auto;
    right: 0;
    background: #170a0b;
    border: solid 1px #black;
    color: #fff;
    padding: 10px 22px;
}

#message-status{
   float: left;padding-left: 5px;padding-right: 10px
}
#message-data{
   float: left
}
   </style>